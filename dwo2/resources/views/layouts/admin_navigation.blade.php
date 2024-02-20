<TABLE border=1>
  <TR>
    <TD nowrap colspan="7" align="left" valign="top" bgcolor="#ffff6a">　オペレーターID：{{ Auth::user()->id }}　{{ Auth::user()->name }}</TD></TR>
  <TR>
    <TD><A href="/admin/product/list"">商品サブマスタ</A></td>
    <TD><A href="/admin/product/big">商品大分類マスタ</A></td>
    <TD><A href="/admin/product/middle">商品中分類マスタ</A></td>
    <TD><A href="/admin/product/category/list">商品分類登録マスタ</A></td>
    <TD><A href="/admin/product/status">商品ステータスマスタ</A></td>
    <TD><A href="/admin/batch/conf">バッチ設定</A></td>
    <TD><A href="/admin/info">お知らせ</A></td>
  </TR>
  <TR>
    <TD><A href="/admin/cust/list">得意先サブマスタ</A></td>
    <TD><A href="/admin/operator/detail">管理ユーザマスタ</A></td>
    <TD><A href="/admin/order/delivery/list">納品先マスタ</A></td>
    <TD><A href="/admin/order/list">受付状況確認</A></td>
    <TD><A href="/admin/order/search/history">受注履歴照会</A></td>
    <TD><A href="/admin/order/status">受注ステータスマスタ</A></td>
    <TD><A href="/admin/test/shipping/form">テスト</A></td>
  </TR>
  <TR>
    <TD><A href="/admin/order/list2">受付編集</A></td>
    <td><a href="/admin/zipdata/update/form">郵便番号辞書更新</a></td>
  </TR>
</TABLE>

