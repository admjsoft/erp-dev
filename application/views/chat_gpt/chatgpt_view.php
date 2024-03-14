<style>
      iframe{
        height: 100vh;
        width: 100%;
        border: none;
        overflow: hidden;
      }

      body{
        margin: 0px;
      }
</style>
<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5 class="title">
                <?php echo $this->lang->line('Jsoft ChatGPT') ?>

            </h5>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
            <iframe src="https://chatgptjsuitescloud.net/" ></iframe>
            </div>
        </div>
    </div>
</div>
<script>
  function resizeIFrame(obj)  {
    obj.style.height = obj.contentWindow.documentEkement.scrollHeight + 'px';
    }
</script>
