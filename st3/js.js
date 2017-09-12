var divWithInput = new Array();

var indexDraggableDiv = 0;

function NewDiv() {
    this.div = $("<div>", {
            "id": indexDraggableDiv,
            "class": "draggable"
        }),
        this.index = 0,
        this.withInput = false,
        this.activeDiv = false,
        this.text = "",
        this.coords = [0, 0]
};

$(document).ready(function () {
  //  $('input').focus();
    loadAllmessages();

    $("div").dblclick(function (event) {

        var id = event.target.id;
        var element = $("#" + id);
        var input = element.find("input")[0];

        if (className.substring(0, 9) === 'draggable') {

            if (!divWithInput[id].withInput) {
                divWithInput[id].withInput = true;
                element.html("<input type='text' onclick='this.select()'/>");

                input = element.find("input")[0];
                input.focus();
                input.value = divWithInput[id].text;
            }


            $("div").click(function (event) {
                var idOther = event.target.id;
                var tag = event.target.tagName;

                if (idOther !== id && tag !== 'INPUT') {
                    input.value = "";
                    input.remove();
                    element.html(divWithInput[id].text);
                    divWithInput[id].withInput = false;
                }
                element.off("click");
            });

            element.keyup(function (e) {
                if (e.keyCode == 13) {
                    if (input.value != "") {
                        element.html(input.value);
                        divWithInput[id].text = input.value;
                        input.remove();
                        divWithInput[id].withInput = false;
                        apdTextJson(divWithInput[id].index, divWithInput[id].text, divWithInput[id].coords);
                        //addToJson(divWithInput[id])
                    } else {
                        deleteFromJson(id);
                        divWithInput[id] = {};
                        element.remove();
                        //indexDraggableDiv--;
                    }
                    element.off("keyup");

                }
            });

            element.keyup(function (e) {
                if (e.keyCode == 27) {
                    input.value = "";
                    input.remove();
                    element.html(divWithInput[id].text);
                    divWithInput[id].withInput = false;

                    element.off("keyup");
                }
            });
        }
        element.off("dblclick");
    });
		$("div").mousedown(function (event) {
        className = event.target.className;
        id = event.target.id;
        element = $("#" + id);
        if (className.substring(0, 9) == 'draggable') {
            element.css('cursor','move');
        }
    });



    $("div").mouseup(function (event) {
        className = event.target.className;
        id = event.target.id;
        element = $("#" + id);
        if (className.substring(0, 9) == 'draggable') {
						element.css('cursor','pointer');
            divWithInput[id].coords = [element.position().left, element.position().top];
            apdCoordsJson(divWithInput[id].index, element.position().left, element.position().top, divWithInput[id].text);
        }
    });
});


var cnt = $("#img_cnt")

cnt.dblclick(function (event) {
    var className = event.target.className;
    var tag = event.target.tagName;
    if (className.substring(0, 9) !== 'draggable' && tag !== 'INPUT') {

        var newDiv = new NewDiv();
        newDiv.div.draggable({
            containment: "parent"
        });

        newDiv.index = indexDraggableDiv;
        cnt.append(newDiv.div);
        if(indexDraggableDiv >= 1 && divWithInput[indexDraggableDiv-1].text == "") {
          $("#" + (indexDraggableDiv - 1)).remove();
          deleteFromJson(indexDraggableDiv - 1)
        }
        if (event.pageX + 70 < cnt.width()) {
            $("#" + indexDraggableDiv).offset({
                top: event.pageY - 80,
                left: event.pageX - 45
            });

            newDiv.coords = [event.pageX - 80, event.pageY - 80];
        } else {
            var diff = event.pageX + 70 - cnt.width();
            $("#" + indexDraggableDiv).offset({
                top: event.pageY - 80,
                left: event.pageX - diff - 45
            });
            newDiv.coords = [event.pageX - 160, event.pageY - 45];
            $("#" + indexDraggableDiv).toggleClass('draggableChange');
        }

        divWithInput[indexDraggableDiv] = newDiv;

        cnt.append(newDiv.div);

        addToJson(newDiv);

        indexDraggableDiv++;
    }
});

function addToJson(obj) {

    $.ajax({

        type: "POST",
        url: "add_to_json.php",
        data: {
            'index': obj.index,
          },
        dataType: 'json',
        cache: false,

    });
}

function apdCoordsJson(index, left, top, text) {
    var obj = {
        'index': index,
        'left': left,
        'top': top,
        'text': text
    };

    $.ajax({

        type: "POST",
        url: "upd_coords_json.php",
        data: obj,
        dataType: 'json',
        cache: false,

    });
}

function apdTextJson(index, text, coords) {
    var obj = {
        'index': index,
        'text': text,
        'coords': coords
    };
    $.ajax({
        type: "POST",
        url: "upd_text_json.php",
        data: obj,
        dataType: 'json',
        cache: false,

    });
}

function LoadedDiv(i, left, top, text) {
    this.div = $("<div>", {
            "id": i,
            "class": "draggable"
        }),
        this.index = i,
        this.withInput = false,
        this.activeDiv = false,
        this.text = text,
        this.coords = [left, top]
}

function loadAllmessages() {
    $.ajax({
        url: "load_from_data.php",
        cache: false,
        success: function (html) {
            $("#img_cnt").append(html);
            $('.draggable').draggable({
                containment: "parent"
            });
            var loadedDivs = $('.draggable');
            for (var i = 0; i < loadedDivs.length; i++) {
                var id = loadedDivs[i].id;
                element = $("#" + id);
                var text = element.text();
                var left = element.position().left;
                var top = element.position().top;
                var obj = new LoadedDiv(id, left, top, text);
                divWithInput[id] = obj;
                if (indexDraggableDiv <= id) {
                    indexDraggableDiv = parseInt(id) + 1;
                }
            }
        }
    });
}

function deleteFromJson(index) {
    $.ajax({
        type: "POST",
        url: "delete_from_json.php",
        data: {
            'index': index
        },
        dataType: 'json',
        cache: false,
    });
}
