/**
 * 存储站点通用配置
 * 
 * @type {object}
 */
export default {
    // 是否开启 debug
    debug: true,

    // 界面主题，目前可以为 'default'（默认主题），'blue'（蓝色主题）
    theme: 'default',

    // 是否隐藏头部 logo
    hideLogo: false,

    defaultLang: 'zh-cn',
    // token: 'abcdefghijklmnopqrstuvwxyz',

    // 站点名称
    siteName: '蝉知企业门户系统',

    // 其他配置
    requestType: 'GET',
    requestFix: '-',
    moduleVar: 'm',
    methodVar: 'f',
    viewVar: 't',

    // 外观配置
    // navigationBarStyle: { frontColor: 'black', backgroundColor: '#fff' }
};
