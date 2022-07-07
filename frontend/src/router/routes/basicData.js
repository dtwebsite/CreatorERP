export default [
    {
        path: '/BasicData/DepartmentDataSetting',
        name: 'BasicData-DepartmentDataSetting',
        component: () => import('@/views/basic-data/DepartmentDataSetting.vue'),
        meta: {
            pageTitle: 'Department Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Department Data Setting', active: true },
            ],
        },
    },
    {
        path: '/BasicData/JobDataSetting',
        name: 'BasicData-JobDataSetting',
        component: () => import('@/views/basic-data/JobDataSetting.vue'),
        meta: {
            pageTitle: 'Job Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Job Data Setting', active: true },
            ],
        },
    },
    {
        path: '/BasicData/StaffDataSettingList',
        name: 'BasicData-StaffDataSettingList',
        component: () => import('@/views/basic-data/staff/List.vue'),
        meta: {
            pageTitle: 'Staff Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Staff Data Setting', active: true },
            ],
        },
    },
    {
        path: '/BasicData/StaffDataSettingDetail',
        name: 'BasicData-StaffDataSettingDetail',
        component: () => import('@/views/basic-data/staff/Detail.vue'),
        meta: {
            pageTitle: 'Staff Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Staff Data Setting', to: { name: 'BasicData-StaffDataSettingList' } },
                { text: 'detail', active: true },
            ],
        },
    },
    {
        path: '/BasicData/StaffDataSettingCreate',
        name: 'BasicData-StaffDataSettingCreate',
        component: () => import('@/views/basic-data/staff/Crud.vue'),
        meta: {
            pageTitle: 'Staff Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Staff Data Setting', to: { name: 'BasicData-StaffDataSettingList' } },
                { text: 'create', active: true },
            ],
        },
    },
    {
        path: '/BasicData/StaffDataSettingEdit',
        name: 'BasicData-StaffDataSettingEdit',
        component: () => import('@/views/basic-data/staff/Crud.vue'),
        meta: {
            pageTitle: 'Staff Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Staff Data Setting', to: { name: 'BasicData-StaffDataSettingList' } },
                { text: 'edit', active: true },
            ],
        },
    },
    {
        path: '/BasicData/CurrencyDataSetting',
        name: 'BasicData-CurrencyDataSetting',
        component: () => import('@/views/basic-data/CurrencyDataSetting.vue'),
        meta: {
            pageTitle: 'Currency Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Currency Data Setting', active: true },
            ],
        },
    },
    {
        path: '/BasicData/ProjectDataSetting',
        name: 'BasicData-ProjectDataSetting',
        component: () => import('@/views/basic-data/ProjectDataSetting.vue'),
        meta: {
            pageTitle: 'Project Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Project Data Setting', active: true },
            ],
        },
    },
    {
        path: '/BasicData/BankDataSettingList',
        name: 'BasicData-BankDataSettingList',
        component: () => import('@/views/basic-data/bank/List.vue'),
        meta: {
            pageTitle: 'Bank Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Bank Data Setting', active: true },
            ],
        },
    },
    {
        path: '/BasicData/BankDataSettingDetail',
        name: 'BasicData-BankDataSettingDetail',
        component: () => import('@/views/basic-data/bank/Detail.vue'),
        meta: {
            pageTitle: 'Bank Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Bank Data Setting', to: { name: 'BasicData-BankDataSettingList' } },
                { text: 'detail', active: true },
            ],
        },
    },
    {
        path: '/BasicData/BankDataSettingCreate',
        name: 'BasicData-BankDataSettingCreate',
        component: () => import('@/views/basic-data/bank/Crud.vue'),
        meta: {
            pageTitle: 'Bank Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Bank Data Setting', to: { name: 'BasicData-BankDataSettingList' } },
                { text: 'create', active: true },
            ],
        },
    },
    {
        path: '/BasicData/BankDataSettingEdit',
        name: 'BasicData-BankDataSettingEdit',
        component: () => import('@/views/basic-data/bank/Crud.vue'),
        meta: {
            pageTitle: 'Bank Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Bank Data Setting', to: { name: 'BasicData-BankDataSettingList' } },
                { text: 'edit', active: true },
            ],
        },
    },
    {
        path: '/BasicData/AccountDataSetting',
        name: 'BasicData-AccountDataSetting',
        component: () => import('@/views/basic-data/AccountDataSetting.vue'),
        meta: {
            pageTitle: 'Account Data Setting',
            breadcrumb: [
                { text: 'Basic Data' },
                { text: 'Account Data Setting', active: true },
            ],
        },
    },
]