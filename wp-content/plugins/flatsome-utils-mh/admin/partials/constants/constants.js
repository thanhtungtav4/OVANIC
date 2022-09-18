const LANG_DATE_PICKER = {
            formatLocale: {
                monthsShort: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                weekdaysShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                weekdaysMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
              
            },
}
const DATE_PICKER_LOCALE_VN = {
        days: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        daysShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        months: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        monthsShort: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        firstDayOfWeek: 1
}

const sevenDaysAgoMoment = (type = 'object', format = 'YYYY/MM/DD') => {
      const from = moment().add(-7, "days").format(format)
      const to = moment().format(format)
      if(type == 'array')
      {
        return [from, to]
      }
      return {from, to};
}

const ORDER_STATUS = {
    'pending'    : 'Chờ thanh toán',
    'processing' : 'Đang xử lý',
    'on-hold'    : 'Tạm giữ',
    'completed'  : 'Hoàn thành',
    'cancelled'  : 'Đã hủy',
    'refunded'   : 'Hoàn trả',
    'failed'     : 'Đã hủy',

};
const ORDER_STATUS_COLOR = {
    'pending'    : 'grey',
    'processing' : 'grey',
    'on-hold'    : 'grey',
    'completed'  : 'green',
    'cancelled'  : 'pink',
    'refunded'   : 'pink',
    'failed'     : 'pink',

};
const LEVEL_COLOR = [
  'primary',
  'green',
  'red',
  'orange',
  'blue',
  'pink',
  'red'
]
const PAYMENT_STATUS = {
  0: {
    label: 'Chờ duyệt',
    color: 'pink'
  },
  1: {
    label: 'Thành công',
    color: 'green'
  },
  2: {
    label: 'Đã hủy',
    color: 'red'
  }
  
}
export  {
    LANG_DATE_PICKER,
    DATE_PICKER_LOCALE_VN,
    LEVEL_COLOR,
    ORDER_STATUS,
    ORDER_STATUS_COLOR,
    PAYMENT_STATUS,
    sevenDaysAgoMoment
}