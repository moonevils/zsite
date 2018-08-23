import chanzhi from './core/index.js';

//app.js
App({
    onLaunch: function () {
        wx.setNavigationBarTitle({
            title: this.config.siteName,
        });
    },
    get config() {
        return chanzhi.config;
    },
    get chanzhi() {
        return chanzhi;
    }
});
