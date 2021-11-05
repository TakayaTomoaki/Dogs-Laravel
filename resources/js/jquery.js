$(function () {
    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        prevText: "<前",
        nextText: "次>︎",
        monthNamesShort: [
            "1月",
            "2月",
            "3月",
            "4月",
            "5月",
            "6月",
            "7月",
            "8月",
            "9月",
            "10月",
            "11月",
            "12月"
        ],
        dayNamesMin: ["日", "月", "火", "水", "木", "金", "土"],
        yearSuffix: "年",
        showMonthAfterYear: true
    });
});

$(function () {
// スクロール時に実行
    $(window).on('scroll', function () {
        // ページ下部のheightを設定
        var document_height = $(document).height();
        var window_height = $(window).height();
        var page_bottom = document_height - window_height;

        // 画面下部にスクロールされている場合
        if (page_bottom * 0.9 <= $(window).scrollTop()) {
            // ajax処理
            ajax_content();
        }
    });

// ajaxコンテンツ追加処理
    function ajax_content() {
        // 追加コンテンツ
        var add_content = '';
        // コンテンツ件数
        var count = $('#count').val();

        // ajax処理
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            datatype: 'json',
            data: {'count': count}
            // 成功
        }).done(function (data) {
            // コンテンツの生成
            $.each(data, function (key, val) {
                add_content = key + " => id : " + val.id + ", user_id : " + val.user_id + ", body : " + val.body + ", image : " + val.image + ", created_at : " + val.created_at + ", dog_name : " + val.dog_name + ", dog_gender : " + val.dog_gender + ", nice : " + val.nice + ", comment : " + val.comment + ", count : " + val.count;
            })
            // コンテンツに追加
            $("#content").append(add_content);
            // 取得件数を加算してセット
            content += data.length
            $("#count").val(content);
            //失敗
        }).fail(function (e) {
            console.log(e);
        });
    }
});
