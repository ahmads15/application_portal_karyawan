var room = 0;

function education_fields(x) {
    var y = x;
    room++;
    room+=y;
    var objTo = document.getElementById("education_fields");
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room);
    var rdiv = "removeclass" + room;
    divtest.innerHTML =
        '<div class="row"><div class="col-sm-3 nopadding"><div class="form-group"><input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="Component Name"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <div class="input-group"> <input type="number" class="form-control" id="Major" name="Major[]" value="" placeholder="IDR"><div class="input-group-append"> <button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');"> <i class="fa fa-minus"></i> </button></div></div></div></div><div class="clear"></div></row>';

    objTo.appendChild(divtest);
}

function remove_education_fields(rid) {
    $(".removeclass" + rid).remove();
}