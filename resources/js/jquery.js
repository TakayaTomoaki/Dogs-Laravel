// noinspection JSJQueryEfficiency

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
            "12月",
        ],
        dayNamesMin: ["日", "月", "火", "水", "木", "金", "土"],
        yearSuffix: "年",
        showMonthAfterYear: true,
    });
});

$(function () {
    $(document).ready(function () {
        var view_box = $(".view_box");

        $(".file").on("change", function () {
            var fileRdr = new FileReader();
            var find_img = $(this).next("img");
            var fileprop = $(this).prop("files")[0];

            if (find_img.length) {
                find_img.nextAll().remove();
                find_img.remove();
            }

            var img =
                '<img width="150" alt="" class="img_view"><br><a href="#" class="img_del">画像を削除する</a>';
            view_box.append(img);

            fileRdr.onload = function () {
                view_box.find("img").attr("src", fileRdr.result);
                img_del(view_box);
            };
            fileRdr.readAsDataURL(fileprop);
        });

        function img_del(target) {
            target.find("a.img_del").on("click", function () {
                if (
                    window.confirm(
                        "サーバーから画像を削除します。\nよろしいですか？"
                    )
                ) {
                    $(this).parent().find("input[type=file]").val("");
                    $(this).parent().find(".img_view, br").remove();
                    $(this).remove();
                }

                return false;
            });
        }
    });
});

$(function () {
    // ajaxコンテンツ追加処理
    function ajax_content() {
        // 追加コンテンツ
        let add_content = "";
        // コンテンツ件数
        let count = Number($("#count").val());

        // ajax処理
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "post",
            datatype: "json",
            data: { count: count },
            // 成功
        })
            .done(function (data) {
                if (add_content !== "") {
                    false;
                }

                // コンテンツの生成
                data[0].map((obj) => {
                    add_content += [
                        `
                <a href="/dog/comment/${obj.id}" class="list-group-item list-group-item-action">
                
                  <div class="media mt-2">
                  `,
                    ];

                    if (obj.dog_image === null) {
                        add_content += [
                            `
                    <svg class="bd-placeholder-img rounded align-self-start mr-3" width="60" height="60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Generic placeholder image">
                      <title>Generic placeholder image</title>
                      <rect width="100%" height="100%" fill="#868e96"/>
                    </svg>
                    `,
                        ];
                    } else {
                        add_content += [
                            `
                    <img src="storage/dog_image/${obj.dog_image}" alt="dog_image" class="bd-placeholder-img rounded mr-3" width="60" height="60">
                    `,
                        ];
                    }

                    add_content += [
                        `
                    <div class="media-body">
                      <div class="col d-flex pl-0">
                        <div class="font-weight-bold mt-0">
                          <object>
                            <a href="/dog/mypage/${obj.user_id}">
                            ${obj.dog_name}`,
                    ];

                    if (obj.dog_gender === 0) {
                        add_content += [`くん`];
                    } else {
                        add_content += [`ちゃん`];
                    }

                    add_content += [
                        `
                            </a>
                          </object>
                        </div>

                        <div class="mb-0 ml-3 small">`,
                    ];

                    let date = new Date(obj.created_at);
                    let monthDay =
                        date.getMonth() + 1 + "月" + date.getDate() + "日";
                    add_content += [
                        `
                        ${monthDay}
                        </div>
                      </div>
                    <p class="text-break">${obj.body}</p>
                    `,
                    ];

                    if (obj.image !== null) {
                        add_content += [
                            `<img src="/storage/image/${obj.image}" alt="share_image" class="bd-placeholder-img rounded mr-3" width="150">`,
                        ];
                    }

                    add_content += [
                        `
                    <div class="col d-flex pl-0">
                      <div class="col-4 d-flex align-items-center justify-content-center">
                        <object>`,
                    ];

                    if (obj.count === 0) {
                        add_content += [
                            `<form method="get" action="/dog/nice">`,
                        ];
                    } else {
                        add_content += [
                            `<form method="get" action="/dog/unlock">`,
                        ];
                    }

                    add_content += [
                        `
                        <input type="hidden" name="id" value="${obj.id}"/>
                        <button type="submit" class="btn p-0 border-0 text-primary rounded-circle btn-post">
                    `,
                    ];

                    if (obj.count === 0) {
                        add_content += [
                            `<i class="fas fa-paw fa-fw" style="color:silver"></i>`,
                        ];
                    } else {
                        add_content += [
                            `<i class="fas fa-paw fa-fw" style="color:red"></i>`,
                        ];
                    }

                    add_content += [
                        `
                    </button>
                    </form>
                    </object>
                    <p class="mb-0 ml-2 text-secondary">${obj.nice}</p>
                    </div>
                    <div class="col-4 d-flex align-items-center text-primary justify-content-center">
                      <i class="far fa-comment fa-fw"></i>
                      <p class="mb-0 ml-2 text-secondary">${obj.comment}</p>
                    </div>
                    <div class="col-4 d-flex"></div>
                    </div>
                  </div>
                  </div>
                  </a>
                    `,
                    ];
                });

                let html = add_content.replace(/,\s*$/, "");
                $("#card").append(html);
                // 取得件数を加算してセット
                count += data[0].length;
                $("#count").val(count);
                $("#done").val(2);
            })
            .fail(function (e) {
                //失敗
                console.log(e);
                false;
            });
    }

    // スクロール時に実行
    $(window).on("scroll", function () {
        // ページ下部のheightを設定
        let done = Number($("#done").val());
        let document_height = $(document).height();
        let window_height = $(window).height();
        let page_bottom = document_height - window_height;

        // 画面下部にスクロールされている場合
        if (
            page_bottom * 0.9 <= $(window).scrollTop() &&
            document.getElementById(count) !== ""
        ) {
            if (done === 0) {
                $("#done").val(1);
                // ajax処理
                ajax_content();
            }
        }
        if (
            page_bottom * 0.9 > $(window).scrollTop() &&
            document.getElementById(count) !== ""
        ) {
            if (done === 2) {
                $("#done").val(0);
            }
        }
    });
});
