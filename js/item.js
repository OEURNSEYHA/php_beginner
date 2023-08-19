$(document).ready(function () {
    $(".loading-inputimg").hide();
    $(".popup").hide();
    $(".popup").click(function () {
        $('.popup').hide();
        $(".form-popup").css({ "margin-top": "-20px", "pointer-events": "none", "opacity": "0" });

    })

    $(".btn-add").click(function () {
        $(".popup").show();
        $(".form-popup").css({ "margin-top": "0px", "pointer-events": "all", "opacity": "1" });

    })

    $("#img-file").change(function () {
        let boximg = $(".box-img")
        let imgname = $("#img");
        let eThis = $(this);
        let frm = eThis.closest('form.upload');
        let frm_data = new FormData(frm[0]);

        $.ajax({
            url: 'itemuploadimg.php',
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
                boximg.css({ "backgroundImage": "url('../Item/image/" + data['img'] + "')" });
            }
        });
    })

   
    $(".btn-save").click(function () {
        let tbl_data = $("#tbl-data");
        let boximg = $(".box-img");
        let id = $("#id"),
            cateid = $("#cateid"),
            name = $("#name"),
            desc = $("#desc"),
            status = $("#status"),
            lang = $("#lang"),
            img = $("#img");

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
            url: 'itemupload.php',
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
               
                let tr = `
                <tr>
                    <td> ${id.val()}</td>
                    <td><span> ${cateid.val()}</span> ${cateid.find('option:selected').text()} </td>
                    <td> ${name.val()} </td>
                    <td> ${desc.val()} </td>
                    <td> ${lang.val()}</td>
                    <td> ${status.val()}</td>
                    <td> <img src="../Item/image/${img.val()}" alt="${img.val()}" width="100px" /> </td>
                    <td><i class="fa-solid fa-pen-to-square btn-edit "></i></td>

                </tr>
        `;
                if(data['dpl']==true){
                    alert("Duplicate name please input again");
                    name.focus();
                    return;
                }else if(data['edit']==true){
                    tbl_data.find('tr:eq('+indexrow+' td:eq(0))').text(id.val());
                    tbl_data.find('tr:eq('+indexrow+') td:eq(1)').html('<span>'+ cateid.val()+' </span> '+cateid.find('option:selected').text()+'');
                    tbl_data.find('tr:eq('+indexrow+') td:eq(2)').text(name.val());
                    tbl_data.find('tr:eq('+indexrow+') td:eq(3)').text(desc.val());
                    tbl_data.find('tr:eq('+indexrow+') td:eq(4)').text(lang.val());
                    tbl_data.find('tr:eq('+indexrow+') td:eq(5)').text(status.val());
                    tbl_data.find('tr:eq('+indexrow+') td:eq(6) img').attr('src','../Item/image/'+img.val()+'');
                    tbl_data.find('tr:eq('+indexrow+') td:eq(6) img').attr('alt',''+img.val()+'');
                }else{
                    tbl_data.find('tr:eq(0)').after(tr);
                    id.val(data['autoid'] + 1);
                    name.val("");
                    name.focus();
                    cateid.val(0);
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
        $(".popup").show();
        $(".form-popup").css({ "margin-top": "0px", "pointer-events": "all", "opacity": "1" });
        let eThis = $(this);
        let parent = eThis.parents('tr');
        let boximg = $(".box-img");
        indexrow = parent.index();
        let id = parent.find("td:eq(0)").text();
        let cateid = parent.find("td:eq(1) span").text();
        let desc = parent.find("td:eq(3)").text();
        let name = parent.find("td:eq(2)").text();
        let lang = parent.find("td:eq(4)").text();
        let status = parent.find("td:eq(5)").text();
        let img = parent.find("td:eq(6) img").attr("alt");
       

        $("#editid").val(id);
        $("#id").val(id);
       
        $("#cateid").val(cateid);
        $("#name").val(name);
        $("#desc").val(desc);
        $("#img").val(img);
        $("#lang").val(lang);
        $("#status").val(status);
      
        boximg.css({ "backgroundImage": "url('../Item/image/" + img + "')" })


    })


})