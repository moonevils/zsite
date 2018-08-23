const layoutSampleData = {
    layouts: [{
        page: 'all',
        name: 'top',
        grid: false, // 默认
        blocks: [2, 3, 5]
    }, {
        page: 'index_index',
        name: 'top',
        grid: true,
        blocks: [6]
    }, {
        page: 'index_index',
        name: 'middle',
        grid: true,
        blocks: [7, 8, 9]
    }, {
        page: 'index_index',
        name: 'bottom',
        grid: true,
        blocks: [20]
    }, {
        page: 'all',
        name: 'bottom',
        grid: false, // 默认
        blocks: [12]
    }],
    blocks: {
        2: {
            id: 2,
            borderless: true,
            grid: 12,
            title: '网站头部',
            type: 'header',
            content: {
                custom: '',
            },
            data: {} // 区块其他数据，例如导航
        },
        3: {
            id: 3,
            borderless: false,
            grid: 4,
            title: '最新文章',
            type: 'latestArticle',
            content: {
                custom: '',
                icon: 'icon-ul-list'
            },
            data: {       // 区块数据
                list: [], // 最新文章信息
            }
        },
        // ...
    }
};