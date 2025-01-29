/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
    extends: [
        'plugin:vue/vue3-recommended',
        'eslint:recommended',
        '@vue/eslint-config-typescript',
        'plugin:prettier/recommended',
    ],
    parserOptions: {
        ecmaVersion: 'latest',
    },
    rules: {
        'no-undef': 'off',
        'vue/component-tags-order': ['error', { order: ['script', 'template', 'style'] }],
        'vue/html-self-closing': [
            'error',
            {
                html: {
                    void: 'always',
                    normal: 'always',
                    component: 'always',
                },
            },
        ],
    },
}
