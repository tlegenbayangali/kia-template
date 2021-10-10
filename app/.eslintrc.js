module.exports = {
    'extends': 'airbnb',
    'rules': {
        'no-console': 'off',
        'no-tabs': 'off',
        'no-undef': 'off',
        'max-len': 'off',
        'linebreak-style': ['error', 'windows'],
        'quote-props': ['error', 'always'],
        'indent': ['error', 4],
        'no-unused-vars': ['warn'],
        'no-restricted-syntax': 'off',
        'no-param-reassign': ['error', { 'props': false }],
        'prefer-arrow-callback': [
            'error',
            { 'allowNamedFunctions': true },
        ],
    },
    'env': {
        'browser': true,
    },
};
