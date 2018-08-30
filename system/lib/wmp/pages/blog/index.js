import { createLayoutPage } from '../../core/layout-page.js';

// 注册页面
Page(createLayoutPage({
  onDataLoad: data => {
    Object.keys(data.data.articles).forEach(articleID => {
      const article = data.data.articles[articleID];
      if (article && Object.keys(data.data.sticks).indexOf(articleID) != -1) {
        delete data.data.articles[articleID];
      }
    })
    return data;
  }
}));
