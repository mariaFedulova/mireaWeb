const calendarBody = $('#calendarBody');
const trs = $('.tr');
const prevMonthButton = $('#prevMonth');
const nextMonthButton = $('#nextMonth');
const monthYearSpan = $('#monthYear');

function generateCalendar(year, month) {

    $.ajax({
        url: 'handlers/calendar_handler.php',
        type: 'POST',
        dataType: 'html',
        success: function (result) {
            let unique = [];
            let values = JSON.parse(result);
            unique = Object.values(values['unique']);
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDayOfMonth = new Date(year, month, 1).getDay();
            console.log(unique);
            let date = 1;
            let week = 1;
            for (let tr of trs) {
                for (i = 1; i < 8; i++) {
                    let _class = "date-a";
                    let fullDate = year + "-0" + (month + 1) + "-" + date;
                    if (week === 1) {
                        if (i < firstDayOfMonth) {
                            tr.innerHTML += `<td></td>`;
                        }
                        else {
                            fullDate = year + "-0" + (month + 1) + "-0" + date;
                            if (unique.indexOf(fullDate) !== -1) {
                                _class = "date-a backlight";
                                console.log(fullDate);
                                console.log(_class);
                            }
                            tr.innerHTML += `<td><a class="${_class}" href='index.php?day=${year}-0${month + 1}-0${date}'>${date}</a></td>`;
                            date++;
                        }
                    }
                    else {
                        let day = date;
                        if (date < 10) {
                            fullDate = year + "-0" + (month + 1) + "-0" + date;
                            day = "0" + date;
                        }
                        if (date > daysInMonth) {
                            tr.innerHTML += `<td></td>`;
                        }
                        else {

                            if (unique.indexOf(fullDate) !== -1) {
                                _class = "date-a backlight";
                                console.log(fullDate);
                                console.log(_class);
                            }
                            tr.innerHTML += `<td><a class="${_class}" href='index.php?day=${year}-0${month + 1}-${day}'>${date}</a></td>`;
                            date++;
                        }

                    }
                }
                week++;
            }
            monthYearSpan.html(`${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`);
        }
    })
}

generateCalendar(new Date().getFullYear(), new Date().getMonth());

prevMonthButton.on('click', function () {
    const currentMonth = new Date().getMonth();
    const currentYear = new Date().getFullYear();
    const newMonth = currentMonth === 0 ? 11 : currentMonth - 1;
    const newYear = currentMonth === 0 ? currentYear - 1 : currentYear;

    for (let tr of trs) {
        tr.innerHTML = "";
    }
    generateCalendar(newYear, newMonth);
});

nextMonthButton.on('click', function () {
    const currentMonth = new Date().getMonth();
    const currentYear = new Date().getFullYear();
    const newMonth = currentMonth === 11 ? 0 : currentMonth + 1;
    const newYear = currentMonth === 11 ? currentYear + 1 : currentYear;

    for (let tr of trs) {
        tr.innerHTML = "";
    }
    generateCalendar(newYear, newMonth);
});