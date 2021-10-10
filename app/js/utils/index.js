import $ from 'jquery';

window.jQuery = $;

export function hasIntersections(currentItem, activeItem) {
    const currentItemAttr = JSON.parse(currentItem.attr('data-id'));
    const activeItemAttr = JSON.parse(activeItem.attr('data-id'));

    const intersections = currentItemAttr.filter((x) => activeItemAttr.includes(x));

    if (intersections.length) {
        return true;
    }
    return false;
}

export function toInt(str) {
    return +str.replace(/\s+/g, '');
}

export function toCurrency(str) {
    const int = toInt(str.toString());
    return int.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ');
}

export function findMinPrice(ctx) {
    let minPrice;
    if (ctx.find('[data-price]').length > 1) {
        const dataPrices = ctx.find('[data-price]');
        const pricesToCompare = [];
        dataPrices.each((idx, item) => {
            const price = $(item).attr('data-price');
            const priceInNumber = price.split(' ').join('');
            pricesToCompare.push(+priceInNumber);
        });
        minPrice = Math.min(...pricesToCompare);
    } else {
        let price = ctx.find('[data-price]');
        price = price.attr('data-price');
        const priceInNumber = price.split(' ').join('');
        minPrice = +priceInNumber;
    }

    minPrice = toCurrency(minPrice);
    return minPrice;
}

export function findCommonMaxPrice(arr) {
    return Math.max(...arr);
}

export function tengenator(str) {
    return `${str} ₸`;
}

export function getEveryMonthPayment(months, percentage) {
    const downPaymentPercentageCalc = $('#down-payment-percentage-calc');
    const totalPrice = toInt(sessionStorage.getItem('total-price'));
    const downPayment = toInt(downPaymentPercentageCalc.val());
    const monthsCount = months;
    const percent = percentage / 100;

    return (((totalPrice * (percent + 1)) - downPayment) / monthsCount).toFixed();
}
