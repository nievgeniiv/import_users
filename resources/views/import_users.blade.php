<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <title>Laravel</title>
    </head>
    <body>
        <div id="app">
            <div>
                <p id="info" style="color: gray; display: none">Идет импорт пользователей</p>
            </div>
            <div>
                <button onclick="push()">Импортировать пользователей</button>
                <p id="report">
                    Всего: <strong> {{ $countAll }} </strong>, Добавлено: <strong>0</strong>, Обновлено: <strong>0
                </p>
            </div>
        </div>
    </body>
</html>
<script>
    let url = 'http://localhost:8000/save/'
    function push() {
        var elInfo = document.getElementById("info")
        elInfo.style.display = ''
        elInfo.style.color = "grey"
        elInfo.innerHTML = "Идет импорт пользователей"
        axios({
            method: 'get',
            url: url
        })
        .then(function (response) {
            let countAll = response.data.countAll
            let countUpdated = response.data.countUpdated ?? 0
            let countCreated = response.data.countCreated ?? 0
            let el = document.getElementById("report")
            el.innerHTML = "Всего: <strong>"
                + countAll + "</strong>, Добавлено: <strong>"
                + countCreated +"</strong>, Обновлено: <strong>"
                + countUpdated +"</strong>"
            elInfo.innerHTML = "Импорт закончен"
            elInfo.style.color = "green"
        });
    }
</script>