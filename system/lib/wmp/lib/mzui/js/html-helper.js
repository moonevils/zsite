/**
 * 拼接元素类
 * 
 * @param {...any} 参数
 * 
 * @example
 * const isActive = false;
 * const isHidden = true;
 * const divClass = classes('btn', ['lg', 'flex-none'], {active: isActive, 'is-hidden': isHidden});
 * // 以上 divClass 最终值为 'btn lg flex-none is-hidden'
 */
export const classes = (...args) => (
    args.map(arg => {
        if (Array.isArray(arg)) {
            return classes(arg);
        } else if (arg !== null && typeof arg === 'object') {
            return Object.keys(arg).filter(className => {
                const condition = arg[className];
                if (typeof condition === 'function') {
                    return !!condition();
                }
                return !!condition;
            }).join(' ');
        }
        return arg;
    }).filter(x => (typeof x === 'string') && x.length).join(' ')
);