 /* Ajax通信開始 */
 $('#get_product').on('click', function(){
    var products = $('#products').val();
    var request = $.ajax({
        type: 'GET',
        url: 'home'+company_name+'product_name',
        cache: false,
        dataType: 'json',
        timeout: 3000
    });

/* 成功時 */
    request.done(function(data){
        alert("通信に成功しました");
        $('#product_name').val(data[0]);
    });

/* 失敗時 */
    request.fail(function(){
        alert("通信に失敗しました");
    });

});