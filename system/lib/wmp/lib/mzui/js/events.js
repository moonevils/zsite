/**
 * 用于存储所有注册的事件
 * @type {object}
 */
const events = {};

/**
 * id 对应的名称
 * @type {object}
 */
const idNamesMap = {};

/**
 * 绑定一个事件
 *
 * @param {string} name 事件名称
 * @param {function} listener 事件回调函数
 * @return {Symbol}
 */
export const on = (name, listener) => {
    const id = Symbol(name);
    const event = {id, listener, name};
    const namedEvents = events[name];
    if (Array.isArray(namedEvents)) {
        namedEvents.push(event);
    } else {
        events[name] = [event];
    }
    idNamesMap[id] = event;
    return id;
};

/**
 * 取消绑定一个或多个事件
 * @param {...Symbol|string} ids 要取消绑定的事件id或名称
 */
export const off = (...idsOrNames) => {
    idsOrNames.forEach(idOrName => {
        if (typeof idOrName === Symbol) {
            const name = idNamesMap[idOrName];
            const namedEvents = events[name];
            const index = namedEvents.findIndex(x => x.id === idOrName);
            if (index > -1) {
                delete idNamesMap[idOrName];
                namedEvents.splice(index, 1);
            }
        } else if(events[idOrName]) {
            const namedEvents = events[idOrName];
            namedEvents.forEach(id => {
                delete idNamesMap[id];
            });
            delete events[idOrName];
        }
    });
};

/**
 * 触发一个事件
 * @param {string} name 要触发的事件名称
 * @param  {...any} args 触发事件回调函数参数
 * @return {void}
 */
export const emit = (name, ...args) => {
    const namedEvents = events[name];
    namedEvents.forEach(event => {
        event.listener(...args);
    });
};
