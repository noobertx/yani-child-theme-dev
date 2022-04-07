<?php
	$agent_phone_call = "(045) 599 85 41";
	$agent_skype = "SkyperUser";
?>
<ul class="agent-information list-unstyled">
	<li class="agent-name">
		<i class="yani-icon icon-single-neutral mr-1"></i> John Doe
	</li>
	<li class="agent-phone-wrap clearfix">
		<i class="yani-icon icon-phone mr-1"></i>
		<span class="agent-phone agent-show-onClick agent-phone-hidden">
			<a href="tel: <?php echo $agent_phone_call; ?>" ><?php echo $agent_phone_call; ?></a>
		</span>

		<i class="yani-icon icon-video-meeting-skype mr-1"></i>
		<span >
			<a href="skype: <?php echo $agent_skype; ?>" ><?php echo $agent_skype; ?></a>
		</span>

		<i class="yani-icon icon-messaging-whatsapp mr-1"></i>
		<span>
			<a href="https://api.whatsapp.com/send?phone=<?php echo $agent_phone_call; ?>" >Hello, I am interested in [The Stuff]</a>
		</span>
	</li>

	<!-- <li class="agent-social-media">
		<span>
			<a class="btn-facebook" target="_blank" href="#">
                <i class="yani-icon icon-social-media-facebook mr-2"></i>
            </a>
		</span>
		<span>
			<a class="btn-instagram" target="_blank" href="#">
                <i class="yani-icon icon-social-media-instagram mr-2"></i>
            </a>
		</span>
		<span>
			<a class="btn-twitter" target="_blank" href="#">
                <i class="yani-icon icon-social-media-twitter mr-2"></i>
            </a>
		</span>
		<span>
			<a class="btn-linkedin" target="_blank" href="#">
                <i class="yani-icon icon-social-media-linkedin mr-2"></i>
            </a>
		</span>
		<span>
			<a class="btn-googleplus" target="_blank" href="#">
                <i class="yani-icon icon-social-media-googleplus mr-2"></i>
            </a>
		</span>
		<span>
			<a class="btn-youtube" target="_blank" href="#">
                <i class="yani-icon icon-social-media-youtube mr-2"></i>
            </a>
		</span>
	</li> -->
	
</ul>