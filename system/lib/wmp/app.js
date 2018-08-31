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
        } else if (this.config.theme) {
            const {theme} = this.config;
            if (theme.navigationFrontColor) {
                wx.setNavigationBarColor({
                    frontColor: theme.navigationFrontColor,
                    backgroundColor: theme.navigationBackgroundColor,
                });
            }
        }
    },
    get config() {
        return chanzhi.config;
    },
    get chanzhi() {
        return chanzhi;
    }
});
