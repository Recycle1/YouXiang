// 上传照片预览部分
window.onload = function() {
	var fileTag = document.getElementById('file_input');
	fileTag.onchange = function() {
		var file = fileTag.files[0]; //获得用户所选择的文件

		if (!/image\/\w+/.test(file.type)) {
			alert("看清楚，这个需要图片！");
			return false;
		}

		var fileReader = new FileReader();
		fileReader.onloadend = function() {
			if (fileReader.readyState == fileReader.DONE) {
				document.getElementById('img').setAttribute('src', fileReader.result);
			}
		};
		fileReader.readAsDataURL(file);
	}

}
