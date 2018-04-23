$(function() {
  
  var CircleMenu = {}

  CircleMenu = {
    $toggleButton: $('[data-circle-menu-toggle]'),
    $buttonsGroup: $('[data-circle-menu-group]'),
    
    init: function() {
      CircleMenu.toggle = CircleMenu.showButtonsGroup;
      CircleMenu.$toggleButton.on('click', function(event) {
        CircleMenu.toggle(event);
      });
    },
    
    showButtonsGroup: function(event) {
      console.log('show');
      event.preventDefault();
      CircleMenu.$buttonsGroup.show();
      CircleMenu.toggle = CircleMenu.hideButtonsGroup;
    },
    
    hideButtonsGroup: function(event) {
      console.log('hide');
      event.preventDefault();
      CircleMenu.$buttonsGroup.hide();
      CircleMenu.toggle = CircleMenu.showButtonsGroup;
    }
  }
  
  CircleMenu.init();
	
	
	
});