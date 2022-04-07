import buildOption from './../../buildOption';


export const headerStyles = {};

var pre = "header-"+buildOption.header_style;
headerStyles.main_header_path = "partials/"

if(pre=="header-shop"){
	headerStyles.main_header_path+="shop/"
}else if(pre=="header-creative"){
	headerStyles.main_header_path+="creative/"
}else{
	headerStyles.main_header_path+="default/"
	headerStyles.header_num=buildOption.header_num;
}


export default headerStyles;
