import config from './config.js';
import my     from './my.js';

/**
 * 站点配置，此配置数据对象已作为全局 App 对象属性
 * 
 * @type {object}
 * @example <caption>在页面中的调用示例</caption>
 * const app = getApp();
 * 
 * // 获取 'defaultLang' 配置
 * const defaultLang = app.config['defaultLang'];
 */
export default Object.assign(config, my);
