const addTaskButton = $(".add-submit");
const taskName = $(".add-input");
const taskDay = $("[name=dayADD]");
const alertWindow = $(".alert");
const addIcon = $('.add__link');
const taskList = $('.tasks__list');

const deleteTaskButton = $('.task__done');

const addFileButton = $('.file-submit');
const uploadForm = $('.uploadForm');
const fileInput = $('.input-file');
const photoDiv = $('.photo__place');

const addEmotionButton = $('.input-select');
const emotionPlace = $('.emotion__place');

const addNoteButton = $(".notes__pen");
const addNoteTextArea = $("#upnotes");
const note = $('.notes__record');

const infoDiv = $('.info__div');
infoDiv.html("");

alertWindow.hide();
addTaskButton.prop('disabled', true);

taskName.on('change', function () {
    if ($(this).val() == '')
        addTaskButton.prop('disabled', true);

    else
        addTaskButton.prop('disabled', false);
});

$('.alert__button').on('click', function () {
    $('.alert__p').remove();
    alertWindow.hide();
});

addIcon.on('click', function () {
    $('#addtask').show();
});

addTaskButton.on('click', function () {
    let user = $(this).data("id");
    $('#addtask').hide();
    $.ajax({
        type: "GET",
        url: "handlers/index_handler.php",
        dataType: "html",
        data: { name: taskName.val(), day: taskDay.val(), user: user },
        success: function (response) {
            let values = JSON.parse(response);
            alertWindow.prepend(`<p class="alert__p">Название: ${values['name']} День:${values['day']}</p>`);
            alertWindow.prepend(`<p class="alert__p">${values['info']}</p>`);
            alertWindow.show();
            taskName.val("");
            taskList.html("");
            for (let task of values['tasks']) {
                taskList.append(`<li class='tasks__item'>
                                <div class='task__item-left'>
                                    <p class='tasks__name'>${task['title']}</p>
                                    <p class='tasks__deadline'>${task['date']}</p>
                                </div>
                                <p class='task__item-right'><a class='task__done' data-title='${task['title']}' data-id='${task['id']}' data-day='${task['date']}'>+</a></p>
                                </li>`);
            }
            console.log(infoDiv);
            infoDiv.append(`<p>Была добавлена задача: ${values['name']} Дата: ${values['day']}</p> <br>`);
            $('.task__done').on('click', deleteTask);
        },
        error: function (http, status, e) {
            console.log(e);
        }
    });
});

function deleteTask() {
    let id = $(this).data('id');
    let day = $(this).data('day');
    let title = $(this).data('title');
    $.ajax({
        type: 'GET',
        url: 'del.php',
        dataType: 'html',
        data: { id: id, day: day },
        success: function (response) {
            let values = JSON.parse(response);
            alertWindow.prepend(`<p class="alert__p">Название: ${title} Дата: ${day}</p>`);
            alertWindow.prepend(`<p class="alert__p">${values['info']}</p>`);
            alertWindow.show();
            taskList.html("");
            console.log(values);
            for (let task of values['tasks']) {
                taskList.append(`<li class='tasks__item'>
                                <div class='task__item-left'>
                                    <p class='tasks__name'>${task['title']}</p>
                                    <p class='tasks__deadline'>${task['date']}</p>
                                </div>
                                <p class='task__item-right'><a class='task__done' data-title='${task['title']}' data-id='${task['id']}' data-day='${task['date']}'>+</a></p>
                                </li>`);
            }
            $('.task__done').on('click', deleteTask);
            let task = values['deleted'][0];
            infoDiv.append(`<p>Была удалена задача: ${task['title']} Дата: ${task['date']}</p> <br>`);
        },
        error: function (http, status, e) {
            console.log(e);
        }
    })
}

deleteTaskButton.on('click', deleteTask);

function addPhoto(e) {
    e.preventDefault();
    let formData = new FormData(this);
    let fileField = fileInput[0].files[0];
    let img = $(this).data('img');
    formData.append('userfile', fileField);
    formData.append('imgId', img);
    formData.append('day', $(this).data('day'));
    $.ajax({
        url: "upload_img.php",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'html',
        success: function (response) {
            console.log(response);
            let values = JSON.parse(response);
            alertWindow.prepend(`<p class="alert__p">Название: ${values['img']} День:${values['day']}</p>`);
            alertWindow.prepend(`<p class="alert__p">${values['info']}</p>`);
            alertWindow.show();
            photoDiv.html(`<div class="img-div"><img class='moments__photo-img' src='${values['img']}' alt='photo' width='200px' height='250px'>
            <br><img id="delete-photo" data-img=${img} data-day=${values['day']} src='images/trash.png' alt='delete' width='40px' height='50px'></div>`);
            $('#delete-photo').on('click', deletePhoto);
            $(this).hide();
            infoDiv.append(`<p>Было добавлено фото: ${values['img']} Дата: ${values['day']}</p> <br>`);
        },
        error: function (http, textStatus, errorThrown) {
            console.log(http);
        }
    });
}

uploadForm.on('submit', addPhoto);

$('#delete-photo').on('click', deletePhoto);

function deletePhoto() {
    let day = $(this).data('day');
    let img = $(this).data('img');
    $.ajax({
        type: 'POST',
        url: 'del_img.php',
        dataType: 'html',
        data: { day: day },
        success: function (response) {
            let values = JSON.parse(response);
            alertWindow.prepend(`<p class="alert__p"> Дата: ${values['day']}</p>`);
            alertWindow.prepend(`<p class="alert__p">${values['info']}</p>`);
            alertWindow.show();
            photoDiv.html("");
            uploadForm.show();
            photoDiv.html(`<form class='uploadForm' enctype='multipart/form-data' data-day=${day} data-img='${img}'>
            <input class='input-file' name='userfile' type='file' required/>
            <button class='file-submit' type='submit'>Добавить фото</button>
        </form>`);
            $('.uploadForm').on('submit', addPhoto);
            $('.img-div').remove();
            infoDiv.append(`<p>Было удалено фото: ${values['img']} Дата: ${values['day']}</p> <br>`);
        },
        error: function (http, status, e) {
            console.log(e);
        }
    })
}

addEmotionButton.on('click', function () {
    let checkedEmotion = $("[name=emotion]:checked").val();
    $.ajax({
        type: "GET",
        url: "del.php",
        dataType: "html",
        data: { emotion: checkedEmotion, day: $(this).data("day"), user: $(this).data("user") },
        success: function (response) {
            let values = JSON.parse(response);
            alertWindow.prepend(`<p class="alert__p">Эмоция: ${checkedEmotion} День:${values['day']}</p>`);
            alertWindow.prepend(`<p class="alert__p">${values['info']}</p>`);
            alertWindow.show();
            emotionPlace.html(`<img class='moments__emotion-img' src='images/${checkedEmotion}.png' alt=${values['emotion']}' width='100px' height='110px'>`);
            infoDiv.append(`<p>Была добавлена эмоция: ${values['emotion']} Дата: ${values['day']}</p> <br>`);
        },
        error: function (http, status, e) {
            console.log(http);
        },
    });
});

addNoteButton.on('click', function () {
    let update = $(this).data("update");
    let user = $(this).data("user");
    $.ajax({
        type: "GET",
        url: "handlers/add_note_handler.php",
        dataType: "html",
        data: { update: update },
        success: function (response) {
            console.log(response);
            let values = JSON.parse(response);
            addNoteTextArea.html(`<form>
                    <textarea class='textarea' name='note' id='note' cols='36' rows='5'>${values['text']}</textarea><br>
                    <input class='notes-submit' data-day=${values['day']} data-note=${values['text']} data-user=${user} type='button' value='Записать'>
                </form>`);
            addNoteTextArea.show();
            $('.notes-submit').on('click', addNote);

        },
        error: function (http, status, e) {
            console.log(http);
        },
    });
});

function addNote() {
    let text = $('.textarea').val();
    let day = $(this).data('day');
    let user = $(this).data('user');
    $.ajax({
        type: "GET",
        url: "del.php",
        dataType: "html",
        data: { note: text, day: day, user: user },
        success: function (response) {
            let values = JSON.parse(response);
            note.html(text);
            alertWindow.prepend(`<p class="alert__p">Заметка: ${values['note']} День:${values['day']}</p>`);
            alertWindow.prepend(`<p class="alert__p">${values['info']}</p>`);
            alertWindow.show();
            $('.textarea').remove();
            $('.notes-submit').remove();
            infoDiv.append(`<p>Была добавлена заметка: ${values['note']} Дата: ${values['day']}</p> <br>`);
        },
        error: function (http, status, e) {
            console.log(http);
        },
    });
}