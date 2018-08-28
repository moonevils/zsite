// components/action-sheet-link.js
import { convertUrl } from '../core/index.js';

Component({
    /**
     * 组件的属性列表
     */
    properties: {
        //   url: String,
        //   'open-type': {
        //       type: String,
        //       value: 'navigate'
        //   },
        actions: {
            type: Array,
            value: []
        }
    },

    externalClasses: ['item'],

    /**
     * 组件的初始数据
     */
    data: {

    },

    /**
     * 组件的方法列表
     */
    methods: {
        onTap: function(event) {
            const { actions } = this.data;
            wx.showActionSheet({
                itemList: actions.map(x => x.title),
                success: function (res) {
                    const item = actions[res.tapIndex];
                    const { url } = item;
                    if (url.indexOf('?m=index&f=index&') > -1) {
                        wx.reLaunch({
                            url: convertUrl(url),
                        });
                    } else {
                        wx.navigateTo({
                            url: convertUrl(url),
                        });
                    }
                },
            });
        }
    },

    ready: function() {
        console.log('ready', this);
    }
})
