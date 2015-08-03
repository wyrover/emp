        <div style="background-color:#d0d0d0;background-image:url(http://weixin.qq.com/zh_CN/htmledition/images/weixin/letter/mmsgletter_2_bg.png);text-align:center;padding:40px;">
            <div class="mmsgLetter" style="width:580px;margin:0 auto;padding:10px;color:#333;background-color:#fff;border:0px solid #aaa;border-radius:5px;-webkit-box-shadow:3px 3px 10px #999;-moz-box-shadow:3px 3px 10px #999;box-shadow:3px 3px 10px #999;font-family:Verdana, sans-serif; ">

                <div class="mmsgLetterHeader" style="height:23px;background:url(http://weixin.qq.com/zh_CN/htmledition/images/weixin/letter/mmsgletter_2_bg_topline.png) repeat-x 0 0;">

                </div>
                <div class="mmsgLetterContent" style="text-align:left;padding:30px;font-size:14px;line-height:1.5;background:url(http://weixin.qq.com/zh_CN/htmledition/images/weixin/letter/mmsgletter_2_bg_wmark.jpg) no-repeat top right;">

                    <div>

                        <p class="salutation" style="font-weight:bold;">
                            Hi,我们收到了您重置密码的需求：
                        </p>
                        <p>别着急，请点击以下链接，我们协助您找回密码：<br>
                            <a href="{{ url('password/reset',[$token]) }}">{{ url('password/reset',[$token]) }}.</a>
                            <br>
                            这个链接将在 {{
		config('auth.reminder.expire', 60) }} 分钟后失效。
                            <br>
                            如果这不是您的邮件请忽略，很抱歉打扰您，请原谅。
                    </div>
                    </div>
                </div>
            </div>





