//logs.js
import {formatDate} from '../../lib/mzui/js/date-helper.js';

Page({
    data: {
        logs: []
    },
    onLoad: function () {
        this.setData({
            logs: (wx.getStorageSync('logs') || []).map(log => {
                return formatDate(new Date(log))
            })
        })
    }
})
