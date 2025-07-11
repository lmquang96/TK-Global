@extends('layouts/contentNavbarLayout')

@section('title', 'Điều khoản dịch vụ')
@section('page-title')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb-style1 mb-0">
    <li class="breadcrumb-item active">
      <a href="javascript:void(0);">Điều khoản dịch vụ</a>
    </li>
  </ol>
</nav>
@endsection

@section('page-style')
@vite('resources/assets/vendor/scss/pages/page-icons.scss')
@endsection

@section('content')
<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  tbody tr td:first-child {
    white-space: nowrap;
  }
</style>
<!-- Text alignment -->
<div class="row">
  <div class="col-md-12">
    <div class="card mb-6">
      <!-- Account -->
      <div class="card-body">
        <h2>
          ĐIỀU KHOẢN SỬ DỤNG TK GLOBAL DÀNH CHO ĐỐI TÁC
        </h2>
        <p>
          ĐIỀU KHOẢN SỬ DỤNG TKGLOBAL.ASIA DÀNH CHO ĐỐI TÁC ("Điều khoản") này đưa ra những điều khoản về việc sử dụng dịch vụ và hợp tác giữa TKGLOBAL.ASIA ("Bên A") và các Đối tác tham gia mạng lưới ("Bên B") theo như định nghĩa ở Điều 1 liên quan đến Mạng lưới quảng cáo liên kết TKGLOBAL.ASIA được cung cấp bởi Bên A. Bên B mặc nhiên đồng ý với nội dung của Điều khoản này và các chỉnh sửa sửa bổ sung nếu có. Hai bên cam kết sẽ tuân thủ nghiêm túc và thực hiện trên tinh thần tin tưởng lẫn nhau.
        </p>
        <h3>
          ĐIỀU 1: ĐỊNH NGHĨA
        </h3>
        <p>
          <ol>
            <li>
              "Bên B" được hiểu là một cá nhân hay cá thể muốn nhận phí quảng cáo thông  qua Bên A bằng cách đăng các quảng cáo do Nhà quảng cáo chỉ định trên trang mạng của mình nhằm liên kết Khách thăm đến Trang mạng bán hàng.
            </li>
            <li>
              "Trang mạng Bên B" được hiểu là một trang mạng Internet hoặc ứng dụng (app) do Bên B vận hành, quản lý và được Bên B đăng ký sử dụng Các dịch vụ.
            </li>
            <li>
              "Nhà quảng cáo" được hiểu là một cá nhân hay công ty có yêu cầu sử dụng Các Dịch vụ theo cách thức Bên A chỉ định nhằm mục tiêu kết nối các Khách thăm đến Trang mạng bán hàng của mình bằng cách đăng quảng cáo trên Trang mạng Bên B.
            </li>
            <li>
              "Trang mạng bán hàng" được hiểu là một trang mạng do Nhà quảng cáo vận hành và quản lý nhằm cung cấp các hàng hóa và dịch vụ của mình.
            </li>
            <li>
              "Khách thăm" hoặc "khách hàng" được hiểu là các cá nhân sẽ truy cập Trang mạng Bên B và được chuyển tiếp tới Trang mạng bán hàng bằng đường dẫn kích hoạt khi nhấp chuột vào quảng cáo do Nhà quảng cáo đăng trên Trang mạng Bên B.
            </li>
            <li>
              "Trang quản lý" được hiểu là một trang mạng chuyên dụng do Bên A cung cấp cho Bên B liên quan đến Các dịch vụ mà qua đó, Bên B có thể lựa chọn quảng cáo mà Bên B muốn thiết lập Liên kết quảng cáo hay xác nhận các điều khoản và điều kiện về phí quảng cáo, v.v.
            </li>
            <li>
              "Liên kết quảng cáo" sẽ có hiệu lực khi Bên B đăng ký đăng tải một bản quảng cáo với Nhà quảng cáo mà Bên B mong muốn và đã lựa chọn từ nhiều chương trình Liên kết quảng cáo có trên Trang quản lý hay từ các nguồn khác nằm trong Các dịch vụ và được Nhà quảng cáo chấp thuận yêu cầu đăng quảng cáo.
            </li>
            <li>
              "Kết quả đăng quảng cáo" được hiểu là bất kì kết quả quảng cáo nào bắt nguồn từ việc Khách thăm truy cập các quảng cáo của Nhà quảng cáo đăng trên Trang mạng Bên B như mua hàng hóa hay đăng kí thành viên, và được đăng ký vào dữ liệu Các dịch vụ. Các kết quả đăng quảng cáo sẽ được tính phí quảng cáo.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 2: PHẠM VI VÀ CÁCH THỨC HỢP TÁC
        </h3>
        <p>
          <ol>
            <li>
              Các dịch vụ được hiểu là dịch vụ đăng quảng cáo trên Trang mạng Bên B theo chỉ định của Nhà quảng cáo. Nếu Khách thăm mua hàng hay đăng kí thành viên, v.v, bằng cách nhấp chuột vào quảng cáo, một khoản phí quảng cáo nhất định tỉ lệ với kết quả đăng quảng cáo sẽ được Nhà quảng cáo thanh toán thông qua Bên A.
            </li>
            <li>
              Bên B có thể xác nhận loại quảng cáo, phí đăng quảng cáo, trạng thái tức thời của quảng cáo, v.v, trên Trang quản lý chuyên dùng dành cho Bên B được Bên A cung cấp trên Internet.
            </li>
            <li>
              Trường hợp Người nộp đơn vận hành trang mạng thuộc một trong các trường hợp sau thì Bên A có khả năng từ chối đơn đăng ký. Thêm vào đó, nếu sau khi được chấp thuận mà Bên A phát hiện ra Bên B hoặc trang mạng nêu trên cũng thuộc một trong các trường hợp sau thì Bên A có thể hủy bỏ việc đăng ký dựa theo các quy định của Thỏa thuận:
              <ol>
                <li>
                  Trang mạng chứa đựng nội dung tục tĩu, khiêu dâm;
                </li>
                <li>
                  Trang mạng chứa đựng nội dung vi phạm Bản quyền tác giả, Bản quyền thương mại, nội dung từ các tên miền được biết đến rộng rãi hay các quyền sở hữu tài sản trí tuệ;
                </li>
                <li>
                  Trang mạng chứa đựng nội dung có tính phỉ báng, bôi nhọ, cản trở việc kinh doanh, vi phạm danh dự, quyền riêng tư, quyền hình ảnh hay các hình thức tương tự;
                </li>
                <li>
                  Trang mạng có liên quan đến các hoạt động đầu tư lừa đảo, bán hàng đa cấp hay các hình thức tương tự hoặc tham gia giới thiệu các hoạt động trên;
                </li>
                <li>
                  Trang mạng có liên quan đến cờ bạc, cá cược (ngoại trừ các trò chơi do Nhà nước vận hành, xổ số hay các trò chơi hợp pháp);
                </li>
                <li>
                  Trang mạng chứa đựng nội dung vi phạm pháp luật hiện hành, các sắc lệnh, các quy định trong ngành, v.v, hay các nội dung trái luật và chống đối xã hội;
                </li>
                <li>
                  Trang mạng chứa đựng nội dung công kích lại trật tự và đạo đức cộng đồng;
                </li>
                <li>
                  Trang mạng chứa đựng nội dung về tôn giáo;
                </li>
                <li>
                  Trang mạng chỉ dành cho người thân, bạn bè, các cá nhân cụ thể sử dụng;
                </li>
                <li>
                  Trang mạng công khai cho công chúng không theo cách thức, ví dụ như, yêu cầu có tên người dùng và mật mã để truy cập;
                </li>
                <li>
                  Trang mạng nghèo nàn về nội dung hay khó hiểu;
                </li>
                <li>
                  Trang mạng chứa đựng số lượng lớn các đường dẫn tới các trang mạng khác;
                </li>
                <li>
                  Trang mạng chứa các nội dung gây hại đến thương hiệu của nhà quảng cáo;
                </li>
                <li>
                  Bên B có những hành vi vi phạm, trực tiếp hoặc gián tiếp gây thiệt hại đến nhà quảng cáo.
                </li>
                <li>
                  Các trường hợp khác mà Bên A xét thấy không phù hợp.
                </li>
              </ol>
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 3: LIÊN KẾT QUẢNG CÁO VỚI NHÀ QUẢNG CÁO
        </h3>
        <p>
          <ol>
            <li>
              Bên B lựa chọn bài quảng cáo (hay chương trình Liên kết quảng cáo) từ Trang quản lý mà Bên B mong muốn đăng trên Trang mạng Bên B.
            </li>
            <li>
              Trường hợp Bên B muốn hợp tác Liên kết quảng cáo với Nhà quảng cáo, Bên B nộp đăng ký sau khi chọn loại quảng cáo, khoản phí đăng quảng cáo, các điều khoản và điều kiện đăng quảng cáo và điều cấm được mô tả trên Trang quản lý. Phí đăng quảng cáo công bố trên Trang quản lý đã bao gồm các thuế tiêu dùng.
            </li>
            <li>
              Trường hợp Bên B đăng ký tham gia Liên kết quảng cáo và được Nhà quảng cáo chấp thuận, hợp tác Liên kết quảng cáo bắt đầu có hiệu lực và Bên B có quyền đăng quảng cáo theo các chuẩn mực mà Nhà quảng cáo đề ra. Bên B theo đây chấp thuận rằng loại quảng cáo, khoản phí đăng quảng cáo, các điều khoản và điều kiện đăng quảng cáo và các điều khoản cấm có thể thay đổi tùy theo mục đích của Nhà quảng cáo. Trường hợp Nhà quảng cáo từ chối đăng ký tham gia Liên kết quảng cáo hay chấm dứt Liên kết quảng cáo trong thời hạn hợp tác, Bên B không có quyền chất vấn nguyên do hay nộp đơn phản đối.
            </li>
            <li>
              Bên A và Nhà quảng cáo có thể xét lập bảng xếp hạng (sau đây gọi là “Thứ hạng”) về các loại phí thanh toán cho Trang mạng Bên B dựa trên các tiêu chí độc lập của mình và xem xét đến nội dung, thể loại, tính chất và hiệu quả, v.v. Nếu Bên A xét thấy có vi phạm về Thỏa thuận, Bên A có thể điều chỉnh Thứ hạng. Bên B không có quyền yêu cầu tiết lộ nguyên nhân của Thứ hạng.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 4. CHỦ THỂ, XÉT DUYỆT VÀ XÁC LẬP KẾT QUẢ ĐĂNG KÝ QUẢNG CÁO
        </h3>
        <p>
          <ol>
            <li>
              Chủ thể của Kết quả đăng quảng cáo theo Các dịch vụ là sự phân chia Kết quả đăng quảng cáo dựa trên các hoạt động nhất định do Nhà quảng cáo quy định như mua hàng, yêu cầu xin thông tin tài liệu, đăng ký thành viên, nhấp chuột vào quảng cáo và đăng ý kiến phản hồi. Phân chia chủ thể có thể dẫn đến phát sinh phí quảng cáo và việc phân loại chủ thể sẽ được lưu trữ trên máy chủ của Các dịch vụ. Nếu dữ liệu trên được thực hiện không do thiên tai hay các sự kiện nằm ngoài tầm kiểm soát của Bên A, chủ thể của Kết quả đăng quảng cáo sẽ được xác định trên cơ sở các dữ liệu do Nhà quảng cáo và Bên B cung cấp.
            </li>
            <li>
              Kết quả đăng quảng cáo sẽ được ấn định bằng quy trình phê duyệt trong đó Nhà quảng cáo (hay Bên A được Nhà quảng cáo ủy quyền) quyết định chấp thuận hay từ chối chủ thể của Kết quả.
            </li>
            <li>
              Việc chấp thuận Kết quả quảng cáo hoàn toàn do chủ quan của Nhà quảng cáo và Bên B không có quyền yêu cầu Nhà quảng cáo hay Bên A tiết lộ các tiêu chí chấp thuận hay các lý do từ chối.
            </li>
            <li>
              Bên A sẽ thanh toán phí quảng cáo cho Bên B dựa trên Kết quả quảng cáo được ấn định theo các  quy định nêu tại Điều 6.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 5. GIÁM SÁT
        </h3>
        <p>
          <ol>
            <li>
              Bên A sẽ tự thực hiện công tác giám sát để xác định Bên B có sử dụng Các dịch vụ tuân theo  quy định của Thỏa thuận hay không.
            </li>
            <li>
              Trường hợp qua việc giám sát, Bên A xác định rằng Bên B có các hành động vi phạm Thỏa thuận hay các hành động bất hợp pháp, hành vi sai trái vi phạm pháp luật hiện hành, hành vi vi phạm gây ảnh hưởng tiêu cực đến nhà quảng cáo hoặc các hành động có tính chất tương tự (sau đây gọi chung là “Hành vi vi phạm”), Bên A có thể từ chối thanh toán toàn bộ hay một phần phí quảng cáo.
            </li>
            <li>
              Trường hợp qua việc giám sát, Bên B bị phát hiện thực hiện Hành vi vi phạm, Bên A có thể hủy bỏ đăng ký của Bên B mà không cần có yêu cầu. Trường hợp Nhà quảng cáo hay Bên A chịu tổn thất do Hành vi vi phạm của Bên B, Nhà quảng cáo hoặc Bên A có quyền yêu cầu Bên B bồi thường thiệt hại. Thêm vào đó, nếu Hành vi vi phạm của Bên B có tính chất hiểm độc và cố ý, Nhà quảng cáo hoặc Bên A có thể áp dụng các biện pháp như khởi kiện hình sự.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 6. BẢO TRÌ CÁC DỊCH VỤ
        </h3>
        <p>
          Việc bảo trì Các dịch vụ có thể được thực hiện định kì hoặc không theo định kì. Bên B không được khiếu nại về việc tạm ngưng Các dịch vụ hay các tổn thất phát sinh trong thời gian bảo trì.
        </p>
        <h3>
          ĐIỀU 7. THÔNG BÁO, THAY ĐỔI VÀ XÓA BỎ NỘI DUNG TỪ PHÍA BÊN B
        </h3>
        <p>
          <ol>
            <li>
              Trường hợp Bên B thay đổi nội dung trên Trang mạng Bên B hay không thể truy cập vào Trang mạng Bên B, Bên B sẽ cập nhật ngay các thay đổi này trên Trang quản lý.
            </li>
            <li>
              Bên B sẽ không có các hành động làm cho bản thân và Trang mạng Bên B trở thành đối tượng của Điều khoản 4.3, 4.4.
            </li>
            <li>
              Trường hợp Bên B không sử dụng được Các dịch vụ hay phát giác các vấn đề khác có liên quan đến Các dịch vụ, Bên B cần thông báo ngay cho Bên A.
            </li>
            <li>
              Trường hợp có thay đổi về thông tin đăng ký sử dụng Các dịch vụ, Bên B cần đăng nhập ngay các thay đổi này vào thông tin đăng ký của mình. Nếu nảy sinh vấn đề bắt nguồn từ việc Bên B không đăng nhập các thay đổi vào thông tin đăng ký, Bên B tự chịu trách nhiệm và mọi phí tổn để xử lý vấn đề, Bên A hoàn toàn không chịu bất kì trách nhiệm nào.
            </li>
            <li>
              Trường hợp Nhà quảng cáo và Bên A xác định rằng nội dung của ý kiến phản hồi không tương thích với phạm trù mà ý kiến phản hồi đang được đăng tải và có  yêu cầu xóa bỏ, Bên B sẽ phải xóa bỏ ý kiến phản hồi nêu trên trong vòng 01 tuần tính từ ngày nhận được thông báo yêu cầu xóa bỏ.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 8. QUẢN LÝ TÊN TRUY CẬP VÀ MẬT MÃ
        </h3>
        <p>
          <ol>
            <li>
              Bên B chịu mọi trách nhiệm về việc sử dụng và quản lý Tên truy cập và mật mã do Bên A cung cấp.
            </li>
            <li>
              Bên B sẽ không để bên thứ ba sử dụng Tên truy cập và/ hoặc mật mã nêu trên và không được cho mượn, ủy nhiệm hay chuyển nhượng Tên truy cập và/ hoặc mật mã để làm vật đảm bảo hay nhằm làm lợi cho bên thứ ba.
            </li>
            <li>
              Trường hợp Các dịch vụ được khai thác do sử dụng Tên truy cập và/ hoặc mật mã cung cấp cho Bên B, Bên B được xem là đã sử dụng Các dịch vụ bất kể thực tế là Các dịch vụ nêu trên do bên thứ ba sử dụng. Bên B phải chịu trách nhiệm về bất kể nguyên nhân gì để xảy ra việc sử dụng nêu trên.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 9. TUÂN THỦ PHÁP LUẬT LIÊN QUAN ĐẾN QUẢNG CÁO
        </h3>
        <p>
          <ol>
            <li>
              Bản quyền tác giả:
              <ol>
                <li>
                  Trên Trang mạng Bên B, Bên B không được thực hiện các hành động bất hợp pháp như vi phạm bản quyền tác giả của Bên A hay của bên thứ ba.
                </li>
                <li>
                  Trường hợp Bên B đăng ý kiến phản hồi, bản quyền tác giả về ý kiến phản hồi nêu trên sẽ thuộc về Bên B hoặc tác giả.
                </li>
                <li>
                  Theo đây, Bên B chấp thuận rằng giấy phép bản quyền tác giả (bao gồm, nhưng không giới hạn về, quyền sao chép, quyền sửa đổi, quyền phát hành và quyền truyền bá cho công chúng) có liên quan đến ý kiến phản hồi đã đăng ký bản quyền sẽ được cấp miễn phí cho Bên A hay Nhà quảng cáo. Thêm vào đó, Bên B sẽ không thực thi quyền tác giả của mình đối với các sản phẩm đã đăng ký bản quyền nhằm chống lại Bên A.
                </li>
              </ol>
            </li>
            <li>
              Hàng hóa liên quan đến chất gây nghiện và/ hoặc mỹ phẩm:
            </li>
            <li>
              Bên B không được, thể hiện rõ hay ngụ ý, quảng cáo, mô tả, phát hành các bài viết không đúng sự thật, thái quá hay gây hiểu nhầm liên quan đến nhãn hiệu,  quy trình sản xuất, hiệu lực, hiệu quả hay tác dụng của các chất gây nghiện và các chất tương tự, mỹ phẩm hoặc thiết bị y tế.
            </li>
            <li>
              Ngoài các hàng hóa nêu trên khoản (1), Bên B không được, thể hiện rõ hay ngụ ý, quảng cáo, mô tả, phát hành các bài viết không đúng sự thật, thái quá hay gây hiểu nhầm liên quan đến thực phẩm dành cho sức khỏe và thực phẩm ăn kiêng, v.v.
            </li>
            <li>
              Các luật hiện hành khác:
            </li>
          </ol>
        </p>
        <p>
          Bên B sẽ tuân thủ luật pháp và các  quy định hiện hành của Việt Nam liên quan đến vận hành trang mạng và đăng tải quảng cáo, các đạo luật hay sắc lệnh kiểm soát việc đăng tải quảng cáo, và không thực hiện hành vi gạ gẫm Khách thăm, hành động ngăn chặn lợi ích của Khách thăm, hành động gây hiểu lầm các tác dụng bằng các diễn giải thái quá.
        </p>
        <p>
          Bên B chịu trách nhiệm trước pháp luật Việt Nam về Sản Phẩm quảng cáo và các thông tin hình ảnh liên quan do Bên B cung cấp cho Bên Bên A, đảm bảo các Sản Phẩm thông tin này là hợp pháp, không trái với đạo đức, thuần phong mỹ tục của Việt Nam ;
        </p>
        <p>
          Trong suốt thời hạn của Thỏa thuận, Bên B đảm bảo có đầy đủ tư cách cũng như quyền pháp lý để cấp phép sử dụng các Sản Phẩm thông tin liên quan cho Bên B , không vi phạm bất cứ quyền của Bên thứ ba nào; Bên Bên B sẽ chịu mọi trách nhiệm liên quan bao gồm nhưng không giới hạn trách nhiệm giải quyết các khiếu nại, yêu cầu của bên thứ ba liên quan đến quyền sở hữu trí tuệ và bất kỳ khiếu nại nào khác; bồi thường thiệt hại cho Bên Bên A và/hoặc bên thứ ba (nếu có) do các hành vi vi phạm của mình gây ra; và đảm bảo cho Bên A vô can với mọi trách nhiệm.
        </p>
        <h3>
          ĐIỀU 10. HÀNH VI BỊ CẤM
        </h3>
        <p>
          <ol>
            <li>
              Trừ trường hợp có văn bản đồng thuận trước từ Bên A, Bên B không được ký kết Thỏa thuận đăng quảng cáo trực tiếp với Nhà quảng cáo mà không có sự tham gia của Bên A hoặc ép buộc Nhà quảng cáo ký kết.  quy định tại điều 1 này sẽ dẫn tới việc hủy bỏ đăng ký của Bên B, ngoại trừ trong trường hợp Bên B trong Thỏa thuận là:
            </li>
            <li>
              Nhà quảng cáo đã từng tham gia sử dụng Các dịch vụ theo sự giới thiệu của Bên B; hoặc
            </li>
            <li>
              Nhà quảng cáo giới thiệu về Các dịch vụ đến Bên B và khuyến khích Bên B tham gia Các dịch vụ.
            </li>
            <li>
              Trường hợp Bên B ký kết Thỏa thuận đăng quảng cáo trực tiếp với Nhà quảng cáo mà không thông báo và nhận được văn bản đồng thuận từ Bên A là vi phạm các  quy định của điều 14.1, Bên A sẽ có quyền chấm dứt việc hợp tác với bên B và thông báo qua email. Mọi quyền lợi tích lũy của bên B sẽ chấm dứt tại thời điểm thông báo.
            </li>
            <li>
              Bên B không thực hiện các hành động không phù hợp với mục đích của Nhà quảng cáo hay mục tiêu của Các dịch vụ, như dùng các hình thức gây áp lực, gạ gẫm hay yêu cầu Khách thăm nhấp chuột vào quảng cáo để Bên B có được phí đăng quảng cáo, hình thức diễn giải rằng bài quảng cáo đang sử dụng hệ thống Liên kết quảng cáo, hay đề cập đến phí đăng quảng cáo, v.v, ngoại trừ nếu đề cập đến khuyến cáo của Nhà quảng cáo.
            </li>
            <li>
              Bên B không thực hiện các hành động nhằm tăng số lượng Kết quả một cách không tự nhiên hay cố ý tăng số lượng các chủ thể Kết quả bằng các phương thức bất hợp pháp, hay vì mục đích không xác đáng, nhằm thu phí quảng cáo cho Bên B hay các cá thể có liên quan.
            </li>
            <li>
              Bên B không thực hiện các hành động (như đặt hàng hay đăng kí thành viên) có thể dẫn tới nhận phí quảng cáo với tư cách là đại diện cho bên thứ ba.
            </li>
            <li>
              Nếu xảy ra một trong các trường hợp sau, Bên B không được thay đổi hay thúc đẩy bên thứ ba thay đổi mã HTML dùng để hiển thị quảng cáo mà Bên A sẽ dùng để đăng quảng cáo. Nếu không thuộc một trong các trường hợp sau, Bên A có thể cho phép Bên B sửa đổi mã HTML nêu trên. Tuy nhiên, nếu sự thay đổi làm phát sinh vấn đề liên quan đến phản ánh Kết quả quảng cáo, Bên B sẽ phải chịu trách nhiệm.
              <ol>
                <li>
                  Nhà quảng cáo không cho phép sử dụng bất kì ngôn ngữ nào khác ngoài mã HTML hiển thị quảng cáo mà Bên A sẽ sử dụng để đăng quảng cáo;
                </li>
                <li>
                  Nếu do thay đổi mã HTML, mà các hiển thị trên quảng cáo về hình ảnh biểu ngữ hay nội dung quảng cáo hay các nội dung tương tự bị thay đổi
                </li>
                <li>
                  Liên quan đến phí thanh toán theo ý kiến phản hồi;
                </li>
                <li>
                  Thông tin trên Trang mạng Bên B có đăng quảng cáo bị che đậy; hoặc
                </li>
                <li>
                  Các trường hợp mà Bên A xét thấy không phù hợp.
                </li>
              </ol>
            </li>
            <li>
              Bên B không dùng mã HTML hiển thị quảng cáo được Bên A sử dụng để đăng quảng cáo tại bất cứ trang nào khác ngoài Trang mạng Bên B đã đăng ký.
            </li>
            <li>
              Dưới đây là toàn bộ phương thức và hoạt động quảng cáo không được phép sử dụng hệ thống của TKGLOBAL.ASIA, bao gồm:
              <i>
                <ol>
                  <li>
                    Hành vi tạo ra lượng truy cập (impression, click) ảo và dữ liệu giả đối với các chương trình của nhà quảng cáo.
                  </li>
                  <li>
                    Hành vi lừa dối hay ép buộc truy cập hay tự động lấy thông tin người dùng khi người dùng truy cập trang mà không được sự đồng ý hoặc không ý thức được
                  </li>
                  <li>
                    Hành vi giả mạo nhà quảng cáo hay cung cấp các thông tin sai lệch nhằm tiếp cận người dùng
                  </li>
                  <li>
                    Hành vi vi phạm các quy định/yêu cầu của nhà quảng cáo khi tham gia chiến dịch
                  </li>
                  <li>
                    Hành vi gây hại đến các đối tượng tham gia trong hệ thống Affiliate Network bao gồm nhà quảng cáo, TKGLOBAL.ASIA và các publisher khác
                  </li>
                  <li>
                    Sử dụng các liên kết của nhà quảng cáo để lừa dối khách hàng truy cập nhằm mục đích khác ngoài việc thực hiện các giao dịch hợp lệ khác
                  </li>
                  <li>
                    Quảng cáo thông tin trên các trang có nội dung độc hại, vi phạm đạo đức và vi phạm pháp luật
                  </li>
                  <li>
                    Phân phối thông tin không đầy đủ, lỗi thời hoặc sai lệch liên quan đến hàng hóa hoặc dịch vụ của nhà quảng cáo, gây ảnh hưởng tiêu cực đến nhà quảng cáo.
                  </li>
                  <li>
                    Việc sử dụng hoặc đăng ký bất kỳ nhãn hiệu hoặc tên thương mại nào tương tự gây nhầm lẫn với TKGLOBAL.ASIA hoặc bất kỳ nhà quảng cáo nào
                  </li>
                  <li>
                    Chặn hoặc can thiệp vào việc truyền dữ liệu URL của người giới thiệu trừ khi có thỏa thuận trước bằng văn bản
                  </li>
                  <li>
                    Hành vi chạy từ khóa thương hiệu hoặc sử dụng từ khóa cố tình viết sai thương hiệu để gây nhầm lẫn (tùy theo yêu cầu của từng nhà quảng cáo)
                  </li>
                  <li>
                    Hành vi chạy quảng cáo trực tiếp tới trang nhà quảng cáo (tùy theo yêu cầu của từng nhà quảng cáo)
                  </li>
                  <li>
                    Hành vi sử dụng hình ảnh của TKGLOBAL.ASIA bao gồm logo, tên thương hiệu, các hình ảnh thuộc hệ thống… dùng cho mục đích thương mại như bán khóa học hay các hoạt động khác khiến người dùng phải trả phí
                  </li>
                  <li>
                    Hành vi tuyên truyền không có thật/sai sự thật/nói quá để lôi kéo người dùng để trở thành Publisher hoặc gây hiểu nhầm về dịch vụ của TKGLOBAL.ASIA
                  </li>
                  <li>
                    Hành vi chạy các nội dung như tuyển cộng tác viên cho bất cứ tên nhà cung cấp nào đang hoạt động trên TKGLOBAL.ASIA. Ví dụ như tuyển cộng tác viên cho Shopee, Lazada, Tiki….
                  </li>
                  <li>
                    Hành vi là nhân viên, hoặc cộng tác viên của Nhà Quảng Cáo, cố ý sử dụng tài khoản Publisher của TKGLOBAL để nhận hoa hồng từ hoạt động tạo các chuyển đổi không mang lại lợi ích cho Nhà Quảng Cáo
                  </li>
                </ol>
              </i>
            </li>
          </ol>
        </p>
        <p>
          TKGLOBAL.ASIA và ADVERTISER phối hợp cùng nhau và liên tục triển khai rà soát kiểm tra định kỳ theo tuần/tháng hoạt động của từng chiến dịch.
        </p>
        <h3>
          ĐIỀU 11. XỬ LÝ VI PHẠM
        </h3>
        <p>
          <ol>
            <li>
              <h4>
                Cơ sở xử phạt:
              </h4>
              <p>
                Trong trường hợp phát hiện bất kỳ hành vi vi phạm của Publisher, tùy theo từng loại vi phạm và mức độ nghiêm trọng, các Publisher vi phạm sẽ được xử lý theo các tiêu chí sau đây:
                <ul>
                  <li>
                    Theo số lần vi phạm: Là số lần mà Publisher thực hiện hành vi bị cấm.
                  </li>
                  <li>
                    Theo mức độ nghiêm trọng: Là ảnh hưởng của hành vi vi phạm từ Publisher đến các đối tượng bao gồm Advertiser, TKGLOBAL.ASIA và Publisher khác.
                  </li>
                  <li>
                    Theo quy định của nhà quảng cáo tại chiến dịch: Ngoài các quy định chung của TKGLOBAL.ASIA, các Publisher phải tuân thủ theo các quy định tại chiến dịch của nhà quảng cáo.
                  </li>
                </ul>
              </p>
              <p>
                Bảng dưới đây là bảng phân chia các mức độ vi phạm. Sau khi xác định được mức độ vi phạm, TKGLOBAL.ASIA áp dụng các chính sách xử lý vi phạm đối với Publisher như sau:
              </p>
              <table class="mb-2">
                <tr>
                  <th>
                    Mức độ
                  </th>
                  <th>
                    Đơn vi phạm (x)
                  </th>
                  <th>
                    Số lần vi phạm (y)
                  </th>
                  <th>
                    Mức độ thiệt hại và nghiêm trọng
                  </th>
                  <th>
                    Lưu ý chung
                  </th>
                </tr>
                <tbody>
                  <tr>
                    <td class="text-center">
                      Level 1
                    </td>
                    <td class="text-center">
                      < 7
                    </td>
                    <td class="text-center">
                      0
                    </td>
                    <td></td>
                    <td rowspan="5">
                      <p>
                        Mức độ thiệt hại sẽ căn cứ trên thống kê của Advertiser và TKGLOBAL.ASIA
                      </p>
                      <p>
                        Mức độ thiệt hại được đánh giá là nghiêm trọng bao gồm:
                      </p>
                      <p>
                        - Ảnh hưởng uy tín của ADV và TKGLOBAL
                      </p>
                      <p>
                        - Ảnh hưởng trực tiếp đến doanh thu/lợi nhuận của ADV và TKGLOBAL (từ 2 triệu Gross Com trở lên)
                      </p>
                      <p>
                        - Ảnh hưởng đến cộng đồng Publisher nói chung.
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      Level 2
                    </td>
                    <td class="text-center">
                      > 7
                    </td>
                    <td class="text-center">
                      1
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      Level 3
                    </td>
                    <td class="text-center">
                      > 10
                    </td>
                    <td class="text-center">
                      2
                    </td>
                    <td class="text-center">
                      x
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      Level 4
                    </td>
                    <td class="text-center">
                      > 10
                    </td>
                    <td class="text-center">
                      3
                    </td>
                    <td class="text-center">
                      x
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      Level 5
                    </td>
                    <td class="text-center" colspan="2">
                      <p>
                        Đây là mức vi phạm nghiêm trọng nhất, bao gồm các hành vi sau:
                      </p>
                      <p>
                        - Cố tình tạo nhiều tài khoản Publisher để thực hiện hành vi vi phạm ở một hoặc nhiều chiến dịch
                      </p>
                      <p>
                        - Vi phạm gây ảnh hưởng đến hình ảnh thương hiệu & uy tín của Advertiser hoặc TKGLOBAL.
                      </p>
                      <p>
                        Vi phạm nghiêm trọng lừa đảo người dùng nhằm chiếm đoạt tài sản giá trị trên 1 triệu đồng.
                      </p>
                    </td>
                    <td class="text-center">
                      x
                    </td>
                  </tr>
                </tbody>
              </table>
              <p>
                Chú ý: Mức phạt trên là mức phạt tối thiểu. Trong một số trường hợp, tuỳ mức độ nghiêm trọng TKGLOBAL.ASIA sẽ áp dụng mức xử phạt năng hơn. Tùy theo từng trường hợp mà phán quyết cuối cùng sẽ thuộc về TKGLOBAL.ASIA và quy định của nhà quảng cáo.
              </p>
            </li>
            <li>
              <h4>
                Quy trình xử lý vi phạm:
              </h4>
              <p>
                Khi TKGLOBAL.ASIA phát hiện hoặc nghi ngờ Publisher có dấu hiệu vi phạm, TKGLOBAL.ASIA sẽ thực hiện các bước sau:
              </p>
              <p>
                B1: Thông báo đến Publisher và yêu cầu giải trình
                <i>
                  <ul>
                    <li>
                      Đối với trường hợp Advertiser phản ánh, yêu cầu phản hồi trong vòng 4h kể từ khi nhận được yêu cầu
                    </li>
                    <li>
                      Đối với trường hợp TKGLOBAL.ASIA phát hiện, yêu cầu phản hồi tối đa trong vòng 2 ngày kể từ khi nhận được yêu cầu
                    </li>
                  </ul>
                </i>
              </p>
              <p>
                B2: Tạm đóng link campaign đang tham gia cho đến khi Publisher chứng minh được không vi phạm
              </p>
              <p>
                B3: Nếu Publisher phản hồi muộn hoặc không phản hồi, TKGLOBAL.ASIA sẽ thực hiện:
                <i>
                  <ul>
                    <li>
                      Khóa link tham gia campaign
                    </li>
                    <li>
                      Không thanh toán các đơn hàng phát sinh trước đó
                    </li>
                  </ul>
                </i>
              </p>
              <p>
                B4: Đối với trường hợp vi phạm, áp dụng các chính sách xử phạt theo các mức độ và dựa trên cơ sở:
                <i>
                  <ul>
                    <li>
                      Hình thức xử phạt của TKGLOBAL.ASIA
                    </li>
                    <li>
                      Quy định của nhà quảng cáo tại mỗi campaign
                    </li>
                  </ul>
                </i>
              </p>
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 12. CHẤM DỨT LIÊN KẾT QUẢNG CÁO
        </h3>
        <p>
          <ol>
            <li>
              Trường hợp Thỏa thuận giữa Bên A và Nhà quảng cáo chấm dứt, Liên kết quảng cáo giữa Nhà quảng cáo và Bên B cũng chấm dứt theo. Bên A sẽ thông báo lập tức đến Bên B.
            </li>
            <li>
              Trường hợp Nhà quảng cáo đề xuất chấm dứt Liên kết quảng cáo với Bên B, Bên A sẽ thông báo ngay cho Bên B và Liên kết quảng cáo sẽ tự động chấm dứt ngay khi nhận được thông báo.
            </li>
            <li>
              Trường hợp Liên kết quảng cáo chấm dứt theo các  quy định tại điều 16, phí quảng cáo phát sinh đến thời điểm chấm dứt Liên kết quảng cáo sẽ tuân theo các  quy định trong THỎA THUẬN.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 13. BÊN B XIN RÚT LUI
        </h3>
        <p>
          <ol>
            <li>
              Bên B có thể xin rút khỏi Các dịch vụ vào bất kỳ thời điểm nào.
            </li>
            <li>
              Ngay khi hoàn thành thủ tục rút lui của Bên B, việc đăng ký tham gia Các dịch vụ cũng bị hủy bỏ. Trường hợp Bên B và Nhà quảng cáo đang tham gia Liên kết quảng cáo khi Bên B xin rút khỏi Các dịch vụ, Liên kết quảng cáo sẽ tự động chấm dứt
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 14. XỬ LÝ THÔNG TIN CÁ NHÂN
        </h3>
        <p>
          Bên B có trách nhiệm cập nhật đầy đủ thông tin lên Publisher Profile và cam kết các thông tin cung cấp là chính xác. Nghiêm cấm việc sử dụng thông tin của người khác để đăng ký.
        </p>
        <p>
          <ol>
            <li>
              Bên A sẽ tuân thủ theo "Chính sách riêng tư" được thiết lập riêng biệt cho việc xử lý thông tin cá nhân (được hiểu là các thông tin có thể giúp xác định danh tính của cá nhân như tên, ngày sinh hay các thông tin mô tả khác) mà Bên A có được từ việc cung cấp Các dịch vụ.
            </li>
            <li>
              Nhằm phòng ngừa các hành vi sai trái về các dịch vụ Liên kết quảng cáo, Bên A sẽ sử dụng và chia sẻ thông tin về các hành vi sai trái của Bên B (như tên Bên B, thông tin trang mạng đăng ký, địa chỉ, tài khoản ngân hàng). Theo đây, Bên B chấp thuận các điều khoản nêu tại điều này.
            </li>
            <li>
              Nếu xảy ra một trong các trường hợp sau, Bên A có thể tiết lộ các thông tin đăng ký và dữ liệu giao dịch của Bên B thu được từ việc vận hành các quảng cáo (hay các chương trình Liên kết quảng cáo):
            </li>
            <li>
              Tòa án, công an, cơ quan thuế hay các đại diện hành chính khác phát lệnh hay tiến hành điều tra.
            </li>
            <li>
              Tiết lộ thông tin về các quảng cáo (hay các chương trình quảng cáo) cho Nhà quảng cáo trong khuôn khổ vận hành Các dịch vụ; với điều kiện chỉ áp dụng điều khoản này khi Bên A đã ký kết thỏa thuận Bảo mật thông tin với Nhà quảng cáo.
            </li>
            <li>
              Bên A sẽ sử dụng và tiết lộ thông tin thống kê hay các thông tin tương tự liên quan đến Bên B nhưng không giúp nhận dạng danh tính của Bên B.
            </li>
            <li>
              Bên A có quyền hủy/đóng hoặc xử lý các tài khoản của bên B mà không cần thông báo trước cho bên B trong trường hợp tài khoản của bên B không hoạt động hoặc hoạt động không theo quy định.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 15. QUYỀN SỞ HỮU TÀI SẢN TRÍ TUỆ
        </h3>
        <p>
          Bất kì và mọi bản quyền tác giả, bản quyền thương mại và các quyền sở hữu trí tuệ khác liên quan đến Các dịch vụ đều thuộc sở hữu của cá thể đã cung cấp các quyền đó, như Bên A hay Nhà quảng cáo. Bên B chỉ sử dụng toàn bộ hay một phần hệ thống hay nội dung Liên kết quảng cáo do Bên A cung cấp trong khuôn khổ cho phép của Bên A hay Nhà quảng cáo, và không thực hiện các hành vi nằm ngoài khuôn khổ cho phép nêu trên vi phạm bản quyền tác giả, v.v, như sao chép, in ấn, xuất bản, công chiếu, và phân bố rộng rãi cho công chúng hoặc có bên thứ ba thực hiện các hành vi nêu trên.
        </p>
        <h3>
          ĐIỀU 16. TẠM NGỪNG, THAY ĐỔI, ĐIỀU CHỈNH, BỔ SUNG VÀ XÓA BỎ CÁC DỊCH VỤ.
        </h3>
        <p>
          Bên A có thể tạm ngưng, thay đổi, điều chỉnh, bổ sung hay xóa bỏ Các dịch vụ vào bất kỳ thời điểm nào. Nếu thấy cần thiết, Bên A có thể thông báo trước cho Bên B về các hành động nêu trên.
        </p>
        <h3>
          ĐIỀU 17. TRAO ĐỔI THÔNG TIN
        </h3>
        <p>
          <ol>
            <li>
              Bên A sẽ gửi thông báo hay trao đổi thông tin với Bên B bằng email đã đăng ký trên hệ thống hay đăng tải lên trang mạng của Các dịch vụ. Bên B có trách nhiệm chủ động cập nhật các thông tin liên quan.
            </li>
            <li>
              Trường hợp Bên A thực hiện trao đổi thông tin qua email, các thông tin này được xem như đã được Bên B nhận vào ngày Bên A gửi email.
            </li>
            <li>
              Trường hợp Bên B thay đổi địa chỉ email hay số điện thoại đăng ký với Bên A, Bên B phải thông báo ngay về các thay đổi này trong thông tin đăng ký. Nếu Bên B không thông báo về các thay đổi nêu trên và không nhận được thông báo từ Bên A, Bên A sẽ không chịu trách nhiệm.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 18. THUẾ VÀ CÁC NGHĨA VỤ PHÁP LÝ
        </h3>
        <p>
          <ol>
            <li>
              Doanh thu thực nhận của Publisher bằng 100% doanh thu trong tháng trừ đi các khoản thanh toán tạm (nếu có), thuế thu nhập cá nhân và các khoản giảm trừ khác (nếu có).
            </li>
            <li>
              Các cá nhân/tổ chức sẽ phải chịu khoản thuế VAT, TNCN (đối với cá nhân), TNDN (đối với doanh nghiệp) với Nhà nước. TKGLOBAL.ASIA sẽ áp dụng việc khấu trừ một phần doanh thu để nộp hộ thuế TNCN đối với các Publisher cá nhân (khoản thuế này sẽ được nộp vào ngân sách Nhà nước theo quy định của pháp luật).
            </li>
            <li>
              Bên B hoàn toàn chịu trách nhiệm về các khoản Thuế và các nghĩa vụ khác có liên quan theo Quy định của Pháp luật Việt Nam.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 19. MIỄN TRỪ TRÁCH NHIỆM
        </h3>
        <p>
          Bên A không có trách nhiệm bồi thường về bất kì thiệt hại nào mà Bên B phải gánh chịu do sử dụng Các dịch vụ ngoại trừ các thiệt hại gây ra do hành vi cố ý hay bất cẩn quá mức  cho phép từ phía Bên A.
        </p>
        <h3>
          ĐIỀU 20. TRÁCH NHIỆM BỒI THƯỜNG THIỆT HẠI
        </h3>
        <p>
          <ol>
            <li>
              Trường hợp Bên B gây thiệt hại cho Bên A hay Nhà quảng cáo, Bên B phải bồi thường mọi thiệt hại thực tế phát sinh cho Bên A hay Nhà quảng cáo.
            </li>
            <li>
              Nếu có phát sinh vấn đề giữa Bên B và bên thứ ba, Bên B phải chịu trách nhiệm và mọi phí tổn để giải quyết vấn đề. Trường hợp Bên A chịu tổn thất do các vấn đề trên, Bên B phải bồi thường mọi thiệt hại thực tế phát sinh cho Bên A.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 21. KHÔNG ỦY NHIỆM CÁC QUYỀN LỢI
        </h3>
        <p>
          Trừ trường hợp có văn bản đồng thuận trước từ Bên A, Bên B không được ủy nhiệm một phần hay toàn bộ các quyền lợi theo THỎA THUẬN cho bên thứ ba, không chuyển nhượng các quyền trên làm vật đảm bảo hay cho phép bên thứ ba sử dụng các quyền trên.
        </p>
        <h3>
          ĐIỀU 22. TRƯỜNG HỢP BẤT KHẢ KHÁNG
        </h3>
        <p>
          Bên A không chịu trách nhiệm về việc không thực thi hay trì hoãn toàn bộ hay một phần Các dịch vụ vì các nguyên nhân nằm ngoài tầm kiểm soát của Bên A bao gồm, nhưng không giới hạn, thiên tai, hỏa hoạn, động đất, biểu tình, lũ lụt, bão, dịch bệnh, bạo động, khủng bố, chiến tranh, các đạo luật chính phủ, tình trạng gián đoạn, hư hỏng dịch vụ liên lạc hay đường truyền Internet.
        </p>
        <h3>
          ĐIỀU 23. THỎA THUẬN KHÁC
        </h3>
        <p>
          <ol>
            <li>
              Bất kì thông tin liên quan đến Nhà quảng cáo hay nội dung trong quảng cáo về hàng hóa, dịch vụ mà Bên A cung cấp cho Bên B bằng cách sử dụng Các dịch vụ đều tính vào thời điểm hiện tại, và Bên A không đảm bảo gì về tính hoàn thiện,  chính xác và hữu dụng của các thông tin nêu trên trong tương lai, Bên A không chịu trách nhiệm về bất kì hậu quả nào liên quan đến việc Bên B đăng tải các quảng cáo nêu trên khi sử dụng Các dịch vụ.
            </li>
            <li>
              Theo đây, Bên B tuyên bố và cam kết rằng Bên B không thuộc một trong các trường hợp sau. Nếu Bên B bị phát hiện đã làm giả các tuyên bố và cam kết nêu trên, Bên B chấp thuận bị hủy bỏ đăng ký tham gia Các dịch vụ. Thêm vào đó, Bên B chấp thuận rằng nếu Bên B hay các tổ chức mà Bên B tham gia bị tổn thất, Bên B sẽ chịu hoàn toàn trách nhiệm:
            </li>
          </ol>
        </p>
        <p>
          Bên B tuyên bố trong thời gian sử dụng Các dịch vụ, Bên B không thuộc một trong các trường hợp sau và cam kết sẽ không trở thành đối tượng của một trong các trường hợp sau:
        </p>
        <p>
          <ol>
            <li>
              Băng nhóm tội phạm có tổ chức;
            </li>
            <li>
              Thành viên của băng nhóm tội phạm có tổ chức;
            </li>
            <li>
              Cá nhân đã từng là thành viên của băng nhóm tội phạm có tổ chức và tính từ thời điểm rút lui đến hiện tại chưa quá 05 năm;
            </li>
            <li>
              Thành viên không chính thức của băng nhóm tội phạm có tổ chức;
            </li>
            <li>
              Bên A liên kết với băng nhóm tội phạm có tổ chức;
            </li>
            <li>
              Tống tiền các Bên A, ví dụ như các tổ chức kiếm tiền phi pháp giả dạng chiến dịch xã hội hay các đơn vị bạo lực trí tuệ xã hội; hoặc
            </li>
            <li>
              Cá thể hay cá nhân tương tự như trên (sau đây gọi chung là "Thành viên băng nhóm tội phạm có tổ chức").
            </li>
            <li>
              Bên B tuyên bố trong thời gian sử dụng Các dịch vụ, Bên B không thuộc một trong các trường hợp sau và cam kết sẽ không trở thành đối tượng của một trong các trường hợp sau:
            </li>
            <li>
              Cá thể hoạt động dưới sự điều khiển bởi Thành viên băng nhóm tội phạm có tổ chức;
            </li>
            <li>
              Cá thể có hoạt động liên quan lớn đến Thành viên băng nhóm tội phạm có tổ chức;
            </li>
            <li>
              Cá nhân hay cá thể lợi dụng các Thành viên băng nhóm tội phạm có tổ chức, ngoài các mục đích khác, nhằm thu lợi nhuận bất hợp pháp cho bản thân hay cho bên thứ ba hay nhằm gây tổn thất cho bên thứ ba;
            </li>
            <li>
              Cá nhân hay cá thể cung cấp ngân quỹ hay cơ sở hạ tầng cho Thành viên băng nhóm tội phạm có tổ chức;
            </li>
            <li>
              Bên A mà nhân viên hay cổ đông vận hành Bên A có quan hệ với Thành viên băng nhóm tội phạm có tổ chức.
            </li>
            <li>
              Theo đây, Bên B cam kết sẽ không tạo điều kiện cho bên thứ ba thực hiện các hành vi thuộc một trong các trường hợp sau:
              <p>
                <ol>
                  <li>
                    Thỉnh cầu dựa trên hành vi bạo lực;
                  </li>
                  <li>
                    Thỉnh cầu bằng hành vi trái pháp luật hay có tính hủy hoại không được pháp luật công nhận;
                  </li>
                  <li>
                    Có liên quan đến các giao dịch, phát ngôn/ hành động có tính đe dọa hay thực hiện các hành vi bạo lực;
                  </li>
                  <li>
                    Gây thiệt hại đến danh tiếng của một Bên A bằng cách lan truyền thông tin sai lệch, sử dụng phương thức lừa đảo hay dùng vũ lực cản trở hoạt động kinh doanh của Bên A; hay
                  </li>
                  <li>
                    Có các hành vi tương tự như trên.
                  </li>
                </ol>
              </p>
            </li>
            <li>
              Trường hợp đăng ký của Bên B bị hủy bỏ dựa theo các  quy định nêu trên, Bên B không được khiếu nại Bên A về bất kì thiệt hại nào gây ra do việc hủy bỏ đăng ký.
            </li>
          </ol>
        </p>
        <h3>
          ĐIỀU 24. HIỆU LỰC THỎA THUẬN
        </h3>
        <p>
          <ol>
            <li>
              Thỏa thuận này sẽ được áp dụng và có hiệu lực kể từ ngày các Bên ký kết và bên Bên B đăng ký tham gia.
            </li>
            <li>
              Bản Thỏa thuận có thể được thay đổi hay bổ sung vào bất kỳ thời điểm nào tùy  vào Bên A và Bên B được xem là chấp thuận các thay đổi, bổ sung khi được thông báo và tiếp tục tham gia Các dịch vụ.
            </li>
            <li>
              Trừ trường hợp được  quy định rõ, bản Thỏa thuận sửa đổi, bổ sung sẽ được áp dụng và có hiệu lực từ thời điểm bản Thỏa thuận nêu trên được đăng tải trên trang mạng cung cấp Các dịch vụ và sẽ điều phối các quan hệ giữa Bên B và Bên A.
            </li>
          </ol>
        </p>
        <p>
          Điều khoản sử dụng này:
        </p>
        <p>
          <ul>
            <li>
              Được thành lập và đưa vào sử dụng vào ngày 15/02/2025
            </li>
            <li>
              Bằng việc tiếp tục sử dụng tài khoản TKGLOBAL.ASIA, các Publisher chấp nhận các cập nhật mới của điều khoản
            </li>
          </ul>
        </p>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
<!--/ Text alignment -->

<!--/ Card layout -->
@endsection
