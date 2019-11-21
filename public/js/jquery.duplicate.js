/** https://github.com/ReallyGood/jQuery.duplicate */
$.duplicate = function(){
  alert('hello')
  var body = $('body');
  body.off('duplicate');
  var templates = {};
  var settings = {};
  var init = function(){
    $('[data-duplicate]').each(function(){
      var name = $(this).data('duplicate');
      var template = $('<div>').html( $(this).clone(true) ).html();
      var options = {};
      var min = +$(this).data('duplicate-min');
      options.minimum = isNaN(min) ? 1 : min;
      options.maximum = +$(this).data('duplicate-max') || Infinity;
      options.parent = $(this).parent();

      settings[name] = options;
      templates[name] = template;
    });
    
    body.on('click.duplicate', '[data-duplicate-add]', add);
    body.on('click.duplicate', '[data-duplicate-remove]', remove);
  };
  
  function add(){
    alert('hello');
    var color = $(".color-select").find(".selected").attr("color");
    $("body").find('.invoice-detail').css({'background-color':color});
   
    var targetName = $(this).data('duplicate-add');
    var selector = $('[data-duplicate=' + targetName + ']');
    var target = $(selector).last();
    if(!target.length) target = $(settings[targetName].parent);
    var newElement = $(templates[targetName]).clone(true);
      
    if($(selector).length >= settings[targetName].maximum) {
      $(this).trigger('duplicate.error');
      return;
    }
    target.after(newElement);
    $(this).trigger('duplicate.add');
    $("body").find('.invoice-detail').css({'background-color':color});
    $('.table th').css({'background-color':color});
    $('hr.divider.margin.hr-list').css({'background-color':color});
    $('td#add-td').css({'border-top':color});
    $("body").find('.btn-remove').css({'background-color':color});
    $('button.btn.btn-add').css({'background-color':color});
    $('svg.svg-inline--fa.fa-check-square.fa-w-14').css({'color':color});
    $('button.btn.btn-remove').css({'border-color':color});
    $('button.btn.btn-remove').css({'color':color});
  }
  
  function remove(){
    var targetName = $(this).data('duplicate-remove');
    var selector = '[data-duplicate=' + targetName + ']';
    var target = $(this).closest(selector);
    if(!target.length) target = $(this).siblings(selector).eq(0);
    if(!target.length) target = $(selector).last();
    
    if($(selector).length <= settings[targetName].minimum) {
      $(this).trigger('duplicate.error');
      return;
    }
    target.remove();
    $(this).trigger('duplicate.remove');
  }
  
  $(init);
};

$.duplicate();