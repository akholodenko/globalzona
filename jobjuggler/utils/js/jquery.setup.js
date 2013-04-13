$(document).ready(function(){
			$.fn.qtip.styles.formStyle = {
				width: 180,
				background: '#4BB74C',
   				color: 'black',
   						border: {
         					width: 1,
         					radius: 5,
         					color: '#4BB74C'
      					},
   				name: 'dark',
   				textAlign: 'center',
   				tip: 'topMiddle'
			}
			
			//login username tooltip
			$('#username').qtip({
   				content: 'Your email address.',
   				position: {
      				corner: {
         				target: 'bottomMiddle',
         				tooltip: 'topMiddle'
      				}
   				},
   				style: 'formStyle',
   				show: { effect: { type: 'fade', length: '1000' } },
   				hide: { effect: { type: 'fade', length: '1000' } }
			});
			
			//login password tooltip
			$('#password').qtip({
   				content: 'Forgot your password? <a href="#" onClick="alert(\'Not yet\');">Click here</a>',
   				position: {
      				corner: {
         				target: 'bottomMiddle',
         				tooltip: 'topMiddle'
      				}
   				},
   				style: 'formStyle',
   				show: { effect: { type: 'fade', length: '1000' } },
   				hide: { effect: { type: 'fade', length: '1000' }, when: 'mouseout', fixed: true }
			});
		});