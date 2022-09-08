let range = document.querySelector('.uacf7-slider.uacf7-range')
let rangeLabel = document.querySelector('.uacf7-slider-label')
let rangeDate = document.querySelector('.form-range-value.uacf7-value')
let rangeInputValue = document.querySelector('#form-range-value')



if (rangeLabel) {
    const minRangeValue = range.getAttribute('Min')
    const maxRangeValue = range.getAttribute('Max')
    rangeDate.innerHTML = '15:00 - 16:00'
    rangeLabel.innerHTML = `Время тест-драйва с ${parseInt(minRangeValue) - 1}:00 до ${maxRangeValue}:00`
    range.addEventListener('input', (event) => {
        let time = parseInt(event.target.value)
        let resultTime =  rangeDate.innerHTML = `${time - 1}:00 - ${time}:00`
        rangeInputValue.value = `${time - 1}:00 - ${time}:00`
    })
}



