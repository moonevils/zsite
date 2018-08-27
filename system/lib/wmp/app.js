import chanzhi from './core/index.js';

//app.js
App({
    onLaunch: function () {
        wx.setNavigationBarTitle({
            title: this.config.siteName,
        });

        if (this.config.navigationBarStyle) {
            wx.setNavigationBarColor({
                frontColor: this.config.navigationBarStyle.frontColor,
                backgroundColor: this.config.navigationBarStyle.backgroundColor,
            });
        }
    },
    get config() {
        return chanzhi.config;
    },
    get chanzhi() {
        return chanzhi;
    }
});
