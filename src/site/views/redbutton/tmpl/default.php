<?php

defined( '_JEXEC' ) or die;

JHtml::_( 'behavior.keepalive' );
JHtml::_( 'behavior.tooltip' );

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load( 'com_swa', JPATH_ADMINISTRATOR );
$doc = JFactory::getDocument();

$buttons = array(
	'http://thebrotherhoodofevilgeeks.files.wordpress.com/2013/12/big-red-button.gif',
	'http://i.kinja-img.com/gawker-media/image/upload/s--t3kW_XqA--/c_scale,fl_progressive,q_80,w_800/1415914174402575245.png',
	'http://1.bp.blogspot.com/-cvVFQZgvlSg/TkAS976zaYI/AAAAAAAAAg8/fLt7iWAngMg/s400/bigredbutton.jpg',
	'http://fatpenguinblog.com/wp-content/uploads/2006/03/button.jpg',
);
$button = $buttons[array_rand( $buttons )];
?>

<h1>THE PAGE</h1>
<p>Only click this is you know what you are doing!</p>
<img src="<?php echo $button; ?>" width="300px" id="redbutton"/>

<script type="text/javascript">
	window.onload = function() {
		document.getElementById("redbutton").onclick = function() {
			alert("Oh my god you clicked it........");
			if (confirm("This could do some really bad stuff...")) {
				if( prompt( "Type YES to continue", "NO!!!!" ) == "YES" ) {
					if(confirm("Did you actually mean to type that?")) {
						if( prompt( "Cool, well, type it again", ";_;" ) == "YES" ) {
							if( prompt( "What is the square root of 876 to the nearest whole number?" ) == "30" ) {
								alert("ooh, clever cloggs, not far to go...");
								if( prompt( "Who wrote the original button?", "a cat" ) == "beaker" ) {
									alert("okay, I'm running out of time to see if you actually know what you are doing.");
									if( prompt("What year is it?") == new Date().getFullYear() ) {
										alert(
											"One day, the dog named John walked over the street.\n"+
											"Suddenly, a pink car with three legs ran over the street. It stopped\n"+
											"and asked for the 5`th session of Friends, but John told that it wasn`t made yet.\n"+
											"The car was angry, and spitted cacodemons out his two mouths.\n"+
											"The cacodemons duplicated each other, and ate up all\n"+
											"the Scooby-snacks. The old lady shouted at Pikachu, and fired\n"+
											"a missile at him. Pikachu evolved into Weedle, and throwed a\n"+
											"burning banana at the car. The banana got angry, and tried to\n"+
											"rule the world. John told the banana that MTV ruled the world, \n"+
											"and ate him. The banana tasted old shoes, wich was not so weird, \n"+
											"because it was a super sayajin. The green pig with the bell, \n"+
											"ran towards the car, and exploded like a sheep.\n"+
											"Suddenly, the car started an earthquake, and the whole world turned\n"+
											"into a ice cream. The orcs started an revenge on Donald Duck, and\n"+
											"turned him to a pink bear. The old lady advanced into level 10, and\n"+
											"turned into a Fire Demon. The fire demon burned down all mushrooms,\n"+
											"(which was the houses on the planet) and fried all flying carrots.\n"+
											"--Fredrik Hauger Olsen (http://www.writtenhumor.com/story/156)"
										);
										alert("That is all..");
									} else {
										alert("soo clooose");
									}
								} else {
									alert("pah! I knew you knew nothing!")
								}
							} else {
								alert("Sorry, this button only allows users with a certain IQ");
							}
						} else {
							alert("haha, your memory isn't what it used to be!")
						}
					} else {
						alert("Well now you look silly...")
					}
				} else {
					alert("It looks like someone can't type..\n(or knows what is good for them)")
				}
			} else {
				alert("Good choice to cancel there!");
			}
		};
	};
</script>

<!-- And let it be know the result system rewrite was done --A -->
