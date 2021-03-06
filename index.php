<?php 

include_once('main.php');
$userData = getMstData($_GET);

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>作業者マスタメンテナンス</title>
<link rel="stylesheet" type="text/css" href="static/style.css">
</head>
<body>
<header>
<h1><a href="/index.php">作業者マスタメンテナンス</a></h1>
<div class="insert">
	<form method="post" action="edit.php">
		<input type="submit" name="insert" class="btn_insert" value="新規投稿">
	</form>
	</div>
</header>
<div class="contents">
<div class="search">
	<form method="get">
	<table class="search_table">
			<tr>
	            <th>検索条件</th>
	        </tr>
	        <tr>
	            <td>作業者名</td>
				<td><input name="user_id" value="<?php echo isset($_GET['user_id']) ? htmlspecialchars($_GET['user_id']) : '' ?>"></td>
				<td>作業者名</td>
				<td><input name="user_nm" value="<?php echo isset($_GET['user_nm']) ? htmlspecialchars($_GET['user_nm']) : '' ?>"></td>
	        </tr>
	        <tr>
				<td>部門</td>
	        <td>
				<select name="bumon_cd" id="bumon_Cd">
					<option value="0" <?php echo empty($_GET['bumon_cd']) ? 'selected' : '' ?>></option>
					<option value="A01" <?php echo isset($_GET['bumon_cd']) && $_GET['bumon_cd'] == 'A01' ? 'selected' : '' ?>>製造部門</option>
					<option value="A02" <?php echo isset($_GET['bumon_cd']) && $_GET['bumon_cd'] == 'A02' ? 'selected' : '' ?>>管理部門</option>
					<option value="A03" <?php echo isset($_GET['bumon_cd']) && $_GET['bumon_cd'] == 'A03' ? 'selected' : '' ?>>技術部門</option>
				</select>
			</td>
	        </tr>
	         <tr>
				 <td>無効を含む</td>
				 <td><input type="checkbox" name="muko_flg" <?php echo isset($_GET['muko_flg']) && htmlspecialchars($_GET['muko_flg']) == true  ? 'checked' : '' ?>></td>
			 </tr>
	         <tr>
				 <td><button type="submit" name="search"  class="btn_search" >検索</button></td>
			 </tr>
	</table>
	</form>
</div>
<div class="result">
	<?php if(isset($userData) && count($userData)): ?>
		<table class="result_table">
			<tr>
				<th>作業者ID</th>
				<th>作業者名</th>
				<th>部門</th>
				<th>作業場</th>
				<th>メールアドレス</th>
				<th>携帯番号</th>
				<th>登録日</th>
				<th>更新日</th>
				<th>無効フラグ</th>
				<th></th>
			</tr>
			<?php foreach($userData as $row): ?>
				<tr>
					<td><?php echo htmlspecialchars($row['USER_ID']) ?></td>
					<td><?php echo htmlspecialchars($row['USER_NM']) ?></td>
					<td><?php echo htmlspecialchars($row['BUMON_MEI']) ?></td>
					<td><?php echo htmlspecialchars($row['SAGYOBA_MEI']) ?></td>
					<td><?php echo htmlspecialchars($row['ADDRESS']) ?></td>
					<td><?php echo htmlspecialchars($row['PHONE']) ?></td>
					<td><?php echo date('Y/m/d',  strtotime(htmlspecialchars($row['TOROKUBI']))) ?></td>
					<td><?php echo date('Y/m/d',  strtotime(htmlspecialchars($row['KOSHINBI']))) ?></td>
					<td><input type="checkbox" disabled <?php echo htmlspecialchars($row['MUKO_FLG']) == 1 ? 'checked' : ''?>></td>
					<td>
						<form method="post" action="edit.php">
							<input type="submit" name="edit" class="btn_edit" value="編集">
							<input type="hidden" name="kanri_no" value=<?php echo htmlspecialchars($row['KANRI_NO']) ?>>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php else: ?>
		<p class="alert alert-danger">検索結果：該当無し</p>
	<?php endif; ?>
</div>
</div>
<footer>
    <br>
</footer>
</body>
</html>
