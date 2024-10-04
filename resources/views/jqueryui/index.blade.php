<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('jquery-ui-1.14.0/jquery-ui.css') }}">
    <style>
        .draggableDiv {
            width: 40ex;
            height: 40px;
            background-color: lightblue;
            border: 1px solid black;
            margin: 20px;
            z-index: 100;
        }

        .targetDiv{
            position: absolute;
            bottom: 5px;
            left: 200px;
            width: 40ex;
            height: 40px;
            background-color: lightgreen;
            border: 1px solid black;
        }

        #container {
            width: 500px;
            height: 100vh;
            background-color: red;
        }

        #selectable .ui-selected {
            background: #ecd38f;
        }
    </style>
</head>

<body>
    <div id="container">
        <div class="draggableDiv">
            <h1>Drag me</h1>
        </div>

        <div class="targetDiv">
            <h1>Drop here</h1>
        </div>


        <ul id="selectable">
            <li>item 1</li>
            <li>item 2</li>
            <li>item 3</li>
            <li>item 4</li>
            <li>item 5</li>
            <li>item 6</li>
            <li>item 7</li>
            <li>item 8</li>
        </ul>
        <button type="button" id="btnSubmit">Submit</button>

        <hr>
        <h2>Sortable</h2>
        <ul id="sortable">
            <li data-id="101">List 1</li>
            <li data-id="102">List 2</li>
            <li data-id="103">List 3</li>
            <li data-id="104">List 4</li>
            <li data-id="105">List 5</li>
            <li data-id="106">List 6</li>
            <li data-id="107">List 7</li>
            <li data-id="108">List 8</li>
        </ul>
        <button type="button" id="btnSortable">Submit</button>

    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="{{ asset('jquery-ui-1.14.0/jquery-ui.min.js') }}"></script>

    <script>
        $('.draggableDiv').draggable({
            containment: '#container'
        });

        $('.targetDiv').droppable({
            drop: function(event, ui){
                alert('dropped');
            }
        });

        $('#selectable').selectable({

        });

        $('#sortable').sortable({

        });

        $("#btnSubmit").click(function (e) {
            e.preventDefault();
            var selectedItems = $('#selectable .ui-selected');
            var selectedValues = [];
            selectedItems.each(function (index, item) {
                selectedValues.push($(item).text());
            });

            console.log(selectedValues);
        });

        $("#btnSortable").click(function (e) {
            e.preventDefault();
            var sortedItems = $('#sortable li');
            var sortedValues = [];
            sortedItems.each(function (index, item) {
                sortedValues.push($(item).data('id'));
            });

            console.log(sortedValues);
        });

    </script>
</body>

</html>
