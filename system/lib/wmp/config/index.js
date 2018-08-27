import config       from './config.js';
import my           from './my.js';
import { isWebUrl } from '../lib/mzui/js/html-helper.js';

// 合并配置
Object.assign(config, my);

// 检查站点配置，如果配置不符合要求则使用 error 字段返回错误信息
if (!config.token) {
    config.error = '站点配置错误：token 字段没有设置值。';
} else if (!config.root) {
    config.error = '站点配置错误：root 字段没有设置值。';
} else if (config.root.startsWith('http://')) {
    config.error = '站点配置错误：root 字段不能使用 http:// 开头，站点根地址需要使用 https 协议。';
}

// 格式化配置值，如果配置的值不符合要求则进行格式化处理
// 如果站点根地址不是 https 协议，则添加 https:// 协议头
if (!config.root.startsWith('https://')) {
    config.root = `https://${config.root}`;
}
// 确保站点根地址以 ‘/‘ 结束
if (!config.root.endsWith('/')) {
    config.root = `${config.root}/`;
}
// 最终检查站点根地址是否是一个合格的 URL 地址
if (!config.error && !isWebUrl(config.root)) {
    config.error = '站点配置错误：root 字段不能使用 http:// 开头，站点根地址需要使用 https 协议。';
}

if (config.debug) {
    console.log('getApp().config =', config);
}

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
export default config;
