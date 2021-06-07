function getSubCategory(id) {
    var product_category_id = id;
    if (product_category_id !== '') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "/getSubCategory",
            dataType: 'json',
            data: {
                product_category_id: product_category_id
            },
            success: function (response) {
                var obj = response;
                if (obj.output === "success") {

                    var html = '<select onchange="javascript:getSecondCategory(this.value);"  class="form-control" id="product_sub_category_id" name="product_sub_category_id"><option value=""> -- </option>';

                    $.each(obj.subCategoryList, function (key, Event) {
                        html += '<option value="' + Event.sub_category_track_id + '">' + Event.sub_category_name + '</option>';
                    });

                    html += '</select>';
                    $("#subCategoryDiv").html(html);
                } else {
                    alert(obj.msg);
                }
            }
        });
    } else {
        alert('Please choose category first');
    }
}

function getSub(id) {
    var second_category_category_id = id;
    if (second_category_category_id !== '') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "/getSub",
            dataType: 'json',
            data: {
                second_category_category_id: second_category_category_id
            },
            success: function (response) {
                var obj = response;
                if (obj.output === "success") {

                    var html = '<select class="form-control" id="second_category_sub_id" name="second_category_sub_id"><option value=""> -- </option>';

                    $.each(obj.subCategoryList, function (key, Event) {
                        html += '<option value="' + Event.sub_category_track_id + '">' + Event.sub_category_name + '</option>';
                    });

                    html += '</select>';
                    $("#subCategoryDiv").html(html);
                } else {
                    alert(obj.msg);
                }
            }
        });
    } else {
        alert('Please choose category first');
    }
}

function getSecondCategory(id) {
    var product_sub_category_id = id;
    if (product_sub_category_id !== '') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "/getSecondCategory",
            dataType: 'json',
            data: {
                product_sub_category_id: product_sub_category_id
            },
            success: function (response) {
                var obj = response;
                if (obj.output === "success") {

                    var html = '<select class="form-control" id="product_second_category_id" name="product_second_category_id"><option value=""> -- </option>';

                    $.each(obj.secondCategoryList, function (key, Event) {
                        html += '<option value="' + Event.second_category_track_id + '">' + Event.second_category_name + '</option>';
                    });

                    html += '</select>';
                    $("#secondCategoryDiv").html(html);
                } else {
                    alert(obj.msg);
                }
            }
        });
    } else {
        alert('Please choose category first');
    }
}
// jQuery(document).ready(function(){
//     jQuery(".menu-button").click(function(){
//         jQuery("mobile-menu-area").addClass("menu-toggle");
//     });
    
// });



// header dropdown icon
	$(document).ready(function(){
		$(".menu-button").click(function(){

			$(".mobile-menu-area").toggleClass("m-menu-zero");

			
		});
		

	});










