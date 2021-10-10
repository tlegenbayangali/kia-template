function translit(s) {
    const map = {
        'а': 'a',
        'ә': 'a',
        'б': 'b',
        'в': 'v',
        'г': 'g',
        'ғ': 'g',
        'д': 'd',
        'е': 'e',
        'ё': 'yo',
        'ж': 'zh',
        'з': 'z',
        'и': 'i',
        'й': 'y',
        'к': 'k',
        'қ': 'q',
        'л': 'l',
        'м': 'm',
        'н': 'n',
        'о': 'o',
        'ө': 'o',
        'п': 'p',
        'р': 'r',
        'с': 's',
        'т': 't',
        'у': 'u',
        'ф': 'f',
        'х': 'kh',
        'һ': 'kh',
        'ц': 'c',
        'ч': 'ch',
        'ш': 'sh',
        'щ': 'shch',
        'ы': 'i',
        'э': 'e',
        'ю': 'yu',
        'я': 'ya',
        'ь': "'",
    };

    return s.replace(new RegExp(Object.keys(map).join('|'), 'ig'), (c) => (map[c] ? map[c] : map[c.toLowerCase()].toUpperCase()));
}

export default (text) => translit(text)
    .toLowerCase()
    .replace(/ /g, '-')
    .replace(/[^\w-]+/g, '');
