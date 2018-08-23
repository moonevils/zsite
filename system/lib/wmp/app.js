import config from './config/config.js';

//app.js
App({
  onLaunch: function () {
      wx.setNavigationBarTitle({
          title: this.config.siteName,
      })
  },
  config: config
});
