$(document).ready(function () {
    $(".loading-inputimg").hide();
    let popup = $(".popup").hide();
    popup.click(function () {
        popup.hide();
        $(".form-popup").css({ "margin-top": "-20px", "pointer-events": "none", "opacity": "0" });
    })

    $(".btn-add").click(function () {
        popup.show();
        $(".form-popup").css({ "margin-top": "0px", "pointer-events": "all", "opacity": "1" });
    })

    $("#img-file").change(function () {
        let boximg = $(".box-img")
        let imgname = $("#img");
        let eThis = $(this);
        let frm = eThis.closest('form.upload');
        let frm_data = new FormData(frm[0]);

        $.ajax({
            url: 'cateuploadimg.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
            },
            success: function (data) {
                //work after success;
                imgname.val(data['img']);
                boximg.css({ "backgroundImage": "url('../Category/image/" + data['img'] + "')" });
            }
        });
    })


    $(".btn-save").click(function () {
        let id = $("#id"),
            name = $("#name"),
            desc = $("#desc"),
            lang = $("#lang"),
            status = $("#status"),
            img = $("#img");
        let tbl_data = $("#tbl-data");
        let boximg = $(".box-img");

        if (id.val() == "") {
            alert("Please input id");
            id.focus();
            return;
        } else if (name.val() == "") {
            alert("Please input name");
            name.focus();
            return;
        } else if (desc.val() == "") {
            alert("Please input description");
            desc.focus();
            return;
        } else if (img.val() == "") {
            alert("Please Choose file");
            return;
        }
        let eThis = $(this);
        let frm = eThis.closest('form.upload');
        let frm_data = new FormData(frm[0]);

        $.ajax({
            url: 'cateupload.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function () {
                //work before success;
            },
            success: function (data) {
                //work after success;
               
                if (data['dpl'] == true) {
                    alert('Duplicate name Please input  again ');
                    name.focus();
                    return;
                }else if (data['edit'] == true) {

                    tbl_data.find('tr:eq('+indexrow+') td:eq(1)').text(name.val());
                    tbl_data.find('tr:eq('+indexrow+') td:eq(2)').text(desc.val());
                    tbl_data.find('tr:eq('+indexrow+') td:eq(3)').text(lang.val());
                    tbl_data.find('tr:eq('+indexrow+') td:eq(4)').text(status.val());
                    tbl_data.find('tr:eq('+indexrow+') td:eq(5) img').attr('src','../Category/image/'+img.val()+'');
                    tbl_data.find('tr:eq('+indexrow+') td:eq(5) img').attr('alt',''+img.val()+'')

                }else{
                    let tr = `
                            <tr>
                                <td>${id.val()}</td>
                                <td>${name.val()}</td>
                                <td>${desc.val()}</td>
                                <td>${lang.val()}</td>
                                <td>${status.val()}</td>
                                <td>  <img src="../Category/image/${img.val()}" alt="${img.val()}" width="100px"></td>
                                <td><i class="fa-solid fa-pen-to-square btn-edit"></i></td>
                            </tr>
                `;
                
                    tbl_data.find('tr:eq(0)').after(tr);

                    id.val(data['autoid'] + 1);
                    name.val("");
                    desc.val("");
                    desc.focus();
                    lang.val(0);
                    status.val(0);
                    $("#img-file").val("");
                    img.val("");
                    boximg.css({ "backgroundImage": "url('../../images/profile.jpg')" });
                }
               



            }
        });
    })


    let indexrow = 0;
    $("body").on("click", ".btn-edit", function () {
        popup.show();
        $(".form-popup").css({ "margin-top": "0px", "pointer-events": "all", "opacity": "1" })
        let eThis = $(this);
        let parent = eThis.parents('tr');
        indexrow = parent.index();

        let id = parent.find('td:eq(0)').text(),
            name = parent.find('td:eq(1) ').text(),
            desc = parent.find(' td:eq(2)').text(),
            lang = parent.find('td:eq(3)').text(),
            status = parent.find('td:eq(4)').text(),
            img = parent.find('td:eq(5) img').attr('alt');

        $("#editid").val(id);
        $("#id").val(id);
        $("#name").val(name);
        $("#desc").val(desc);
        $("#lang").val(lang);
        $("#status").val(status);
        $(".box-img").css({ "backgroundImage": "url('../Category/image/" + img + "')" });
        $("#img").val(img);
    })



})