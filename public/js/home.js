$(function(){   

// カラムのクリックイベント
$("th").on('click',function(){
  // ★span要素の独自属性（sort）の値を取得
  var sortClass = $(this).find("span").attr("sort");
  var sortFlag = "asc";
  // 初期化
  $("table thead tr span").text("");
  $("table thead tr span").attr("sort", "");
  
  if(isBlank(sortClass) || sortClass == "asc") {
    $(this).find("span").text("▼");
    // ★独自属性（sort）の値を変更する
    $(this).find("span").attr("sort", "desc");
    sortFlag = "desc";
  } else if(sortClass == "desc") {
    $(this).find("span").text("▲");
    $(this).find("span").attr("sort", "asc"); 
    sortFlag = "asc";
  }
  
  var element = $(this).attr("id");
  sort(element, sortFlag);
  });
  
  
  /******** 共通関数 ********/
  function sort(element, sortFlag) {
  // ★sort()で前後の要素を比較して並び変える。※対象が文字か数値で処理を変更
  var arr = $("table tbody tr").sort(function(a, b) {
  if ($.isNumeric($(a).find("td").eq(element).text())) {
  // ソート対象が数値の場合
  var a_num = Number($(a).find("td").eq(element).text());
  var b_num = Number($(b).find("td").eq(element).text());
  
  if(isBlank(sortFlag) || sortFlag == "desc") {
   // 降順
   return b_num - a_num;
  } else {
   // 昇順
   return a_num - b_num;
  }
  } else {
  // ソート対象が数値以外の場合
  var sortNum = 1;
  if($(a).find("td").eq(element).text() 
      > $(b).find("td").eq(element).text()) {
   sortNum = 1;
  } else {
   sortNum = -1;
  }
  if(isBlank(sortFlag) || sortFlag == "desc") {
   // 降順
   sortNum *= (-1) ;
  }
  
  return sortNum;
  }
  });
  // ★html()要素を置き換える
  $("table tbody").html(arr);
  }
  
  
  });
  

//検索機能
$('#keyword').on('click',function(){
  let data = $('#product_name').val();
  $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url:'/home'+'/search',
      type:'GET',
      datatype:'json',
      data: {
          'product_name': data,
      },
      cache: false,
    }).done((data) => {
      let id = data.products[0].id
      let names = data.products[0].product_name
      let company_name = data.products[0].company_name
      let price =  data.products[0].price
      let stock = data.products[0].stock
      $('#id').text(id);
      $('#names').text(names);
      $('#company_name').text(company_name);
      $('#price').text(price);
      $('#stock').text(stock);
  }).fail(function() {
    alert('エラー');
  });
})


$('#searchprice').on('click',function(){
  let da = $('#minPrice').val();
  let ba = $('#maxPrice').val();
  $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url:'/home'+'/search',
      type:'GET',
      datatype:'json',
      data: {
          'minPrice': da,
          'maxPrice': ba,
      },
      cache: false,
    }).done((data) => {
      let id = data.prices[0].id
      let names = data.prices[0].product_name
      let company_name = data.prices[0].company_name
      let price =  data.prices[0].price
      let stock = data.prices[0].stock
      $('#id').text(id);
      $('#names').text(names);
      $('#company_name').text(company_name);
      $('#price').text(price);
      $('#stock').text(stock); 
  }).fail(function() {
    alert('エラー');
  });
})

$('#searchstock').on('click',function(){
  let min = $('#minStock').val();
  let max = $('#maxStock').val();
  $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url:'/home'+'/search',
      type:'GET',
      datatype:'json',
      data: {
          'minStock':min,
          'maxStock':max,
      },
      cache: false,
    }).done((data) => { 
      let id = data.stockers[0].id
      let names = data.stockers[0].product_name
      let company_name = data.stockers[0].company_name
      let price =  data.stockers[0].price
      let stock = data.stockers[0].stock
      $('#id').text(id);
      $('#names').text(names);
      $('#company_name').text(company_name);
      $('#price').text(price);
      $('#stock').text(stock); 
  }).fail(function() {
    alert('エラー');
  });
})

//削除機能
$('#delete').on('click',function(){
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});
  var deleteConfirm = confirm('削除していいんですか？');
  var id= $(this).data("id");
  if(deleteConfirm == true) {
    var clickEle = $(this)
    // 削除ボタンにユーザーIDをカスタムデータとして埋め込んでます。
    var id = clickEle.attr('id');
      $.ajax({
          url: '/product/'+'delete/'+id,
          type:'POST',
          datatype:'json',
          data: {'id': id,
          "_method": "DELETE"
            },
      })
      .done(function() {
        // 通信が成功した場合、クリックした要素の親要素の <tr> を削除
        clickEle.parents('tr').remove();
      })
      .fail(function() {
        alert('エラー');
      });
  };

  $(function () {
    $('.js-open').on('click',function () {
      $('#overlay, .modal-window').fadeIn();
    });
    $('.js-close').on('click',function () {
      $('#overlay, .modal-window').fadeOut();
    });
  });
  
  
    
});




