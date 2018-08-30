import WxParse from '../lib/wxParse/wxParse.js';

/**
 * 获取当前页面 URL
 * 
 * @return {string}
 */
const getCurrentPageUrl = () => {
    const pages = getCurrentPages();
    const currentPage = pages[pages.length - 1];
    return currentPage.route;
};

// 获取全局 app 对象
const app = getApp();
// 获取 chanzhi 和 config 对象
const {chanzhi, config} = app;

const pageTitleCache = {};

/**
 * 创建蝉知通用布局注册页面时的配置对象
 *
 * @param {object} options 注册参数
 * @return {object}
 */
export const createLayoutPage = (options = {}) => {
    let { moduleName, methodName } = options;

    // 获取注册页面配置
    return Object.assign({}, options, {
        /**
         * 页面绑定的数据
         */
        data: {
            loading: true,
            layouts: {},
            config
        },

        /**
         * 处理页面加载完成事件
         */
        onLoad: function (params) {
            const currentPageUrl = getCurrentPageUrl();
            const currentPageUrlSegs = currentPageUrl.split('/');
            if (!moduleName) {
                moduleName = currentPageUrlSegs[currentPageUrlSegs.length - 2];
                this.moduleName = moduleName;
            }
            if (!methodName) {
                methodName = currentPageUrlSegs[currentPageUrlSegs.length - 1];
                this.methodName = methodName;
            }

            const errorMessage = chanzhi.error;
            if (errorMessage) {
                app.errorMessage = errorMessage;
                wx.redirectTo({
                    url: '../error/index',
                });
                return;
            }
            this.serverUrl = chanzhi.getServerUrl(moduleName, methodName, params);

            if (pageTitleCache[this.serverUrl]) {
                wx.setNavigationBarTitle({
                    title: pageTitleCache[this.serverUrl],
                });
            }

            this.loadData();
            if (options.onLoad) {
                options.onLoad(params);
            }
            if (config.debug) {
                console.log('LayoutPage.onLoad', this);
            }
        },

        /**
         * 尝试从服务器获取数据并刷新页面，如果当前已经正在获取数据过程中，则放弃此次请求
         */
        tryLoadData: function () {
            if (this.request && this.request.working) {
                return;
            }
            return this.loadData();
        },

        /**
         * 从服务器获取数据并刷新页面，如果当前已经正在获取数据过程中，则放弃之前的请求，重新获取数据
         */
        loadData: function () {
            // 检查是否有上个请求进行中，如果有则取消上次的请求
            if (this.request && this.request.working) {
                this.request.abort();
                if (config.debug) {
                    console.log('LayoutPage.loadData: abort last request and start a new one.');
                }
            }

            if (config.debug) {
                console.log('LayoutPage.loadData', this.serverUrl);
            }

            // 显示正在加载提示
            wx.showNavigationBarLoading();

            // 发起 ajax 请求
            this.request = chanzhi.ajaxGet({
                url: this.serverUrl,
                complete: () => {
                    wx.hideNavigationBarLoading();
                    wx.stopPullDownRefresh();
                    this.request = null;
                }
            }).then(data => {
                // 格式化服务器端数据
                delete data.status;

                // 格式化布局中的区块对象，将 content 字段从字符串转换为 js 对象
                if (data.layouts) {
                    Object.keys(data.layouts).forEach(pageName => {
                        const pageLayout = data.layouts[pageName];
                        Object.keys(pageLayout).forEach(layoutName => {
                            const blocks = pageLayout[layoutName];
                            blocks.forEach(block => {
                                if (block.titleless === '0') {
                                    block.titleless = false;
                                }
                                if (block.borderless === '0') {
                                    block.borderless = false;
                                }
                                if (block && block.content && typeof block.content === 'string') {
                                    block.content = JSON.parse(block.content);
                                    if (block.type === 'htmlcode' && block.content.content) {
                                        block.content.setData = data => {
                                            if (data.article) {
                                                block.content.article = data.article;
                                            }
                                        };
                                        WxParse.wxParse('article', 'html', block.content.content, block.content, 5);
                                    }
                                }
                            });
                        })
                    });
                }

                if (this.onDataLoad) {
                    data = this.onDataLoad.call(this, data);
                }

                // 更新导航栏标题
                if (data.data && data.data.title) {
                    wx.setNavigationBarTitle({
                        title: data.data.title
                    });
                    pageTitleCache[this.serverUrl] = data.data.title;
                }
                // 如果服务器端有设置导航条样式则应用服务器上的设置
                if (data.navigationStyle) {
                    wx.setNavigationBarColor({
                        frontColor: data.navigationStyle.frontColor,
                        backgroundColor: data.navigationStyle.backgroundColor,
                    });
                }

                // 取消显示正在加载的提示
                data.loading = false;

                // 更新界面
                this.setData(data);

                if (config.debug) {
                    console.log('LayoutPage.data', this.data);
                    global.layoutData = this.data;
                }
            }).catch(error => {
                wx.showModal({
                    title: '无法从服务器获取数据。（Cannot get data from remote server.）',
                    content: (error instanceof Error) ? error.message : error,
                });
            });
            return this.request;
        },

        /**
         * 处理下拉刷新请求
         */
        onPullDownRefresh: function () {
            if (options.onPullDownRefresh && options.onPullDownRefresh() === false) {
                return;
            }
            return this.tryLoadData();
        }
    });
};

/**
 * 注册蝉知通用布局页面
 * 
 * @param {object} options 注册参数
 */
export default (options) => {
    // 注册页面
    Page(createLayoutPage(options));
};
