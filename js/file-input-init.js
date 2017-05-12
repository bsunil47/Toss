jQuery.noConflict();
jQuery("#file-0").fileinput({
    'allowedFileExtensions' : ['jpg', 'png','gif'],
});
jQuery("#file-1").fileinput({
    initialPreview: ["<img src='Desert.jpg' class='file-preview-image'>", "<img src='Jellyfish.jpg' class='file-preview-image'>"],
    initialPreviewConfig: [
        {caption: 'Desert.jpg', width: '120px', url: '#'},
        {caption: 'Jellyfish.jpg', width: '120px', url: '#'},
    ],
    uploadUrl: '#',
    allowedFileExtensions : ['jpg', 'png','gif'],
    overwriteInitial: false,
    maxFileSize: 1000,
    maxFilesNum: 10,
    //allowedFileTypes: ['image', 'video', 'flash'],
    slugCallback: function(filename) {
        return filename.replace('(', '_').replace(']', '_');
    }
});
/*
 jQuery(".file").on('fileselect', function(event, n, l) {
 alert('File Selected. Name: ' + l + ', Num: ' + n);
 });
 */
jQuery("#file-3").fileinput({
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-primary btn-lg",
    fileType: "any"
});
jQuery("#file-4").fileinput({
    uploadExtraData: [
        {kvId: '10'}
    ],
});
jQuery(".btn-warning").on('click', function() {
    if (jQuery('#file-4').attr('disabled')) {
        jQuery('#file-4').fileinput('enable');
    } else {
        jQuery('#file-4').fileinput('disable');
    }
});
jQuery(".btn-info").on('click', function() {
    jQuery('#file-4').fileinput('refresh', {previewClass:'bg-info'});
});
/*
 jQuery('#file-4').on('fileselectnone', function() {
 alert('Huh! You selected no files.');
 });
 jQuery('#file-4').on('filebrowse', function() {
 alert('File browse clicked for #file-4');
 });
 */
jQuery(document).ready(function() {
    jQuery("#test-upload").fileinput({
        'showPreview' : false,
        'allowedFileExtensions' : ['jpg', 'png','gif'],
        'elErrorContainer': '#errorBlock'
    });
    /*
     jQuery("#test-upload").on('fileloaded', function(event, file, previewId, index) {
     alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
     });
     */
});
