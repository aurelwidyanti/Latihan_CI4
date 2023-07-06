<?= $this->extend('components/layout_clear') ?>
<?= $this->section('content') ?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Verify to XiaoMay</h5>
                  </div>

                  <?php
                        if (session()->getFlashData('success')) {
                        ?>
                            <div class="col-12 alert alert-success" role="alert">
                                <p class="mb-0">
                                    <?= session()->getFlashData('success') ?>
                                </p>
                            </div>
                        <?php
                        }
                        ?>
                        
                  <?php
                        if (session()->getFlashData('failed')) {
                        ?>
                            <div class="col-12 alert alert-danger" role="alert">
                                <p class="mb-0">
                                    <?= session()->getFlashData('failed') ?>
                                </p>
                            </div>
                        <?php
                        }
                        ?>
                        
                <form action="<?php echo base_url("/verify")?>" method="post" class="row g-3 needs-validation">
                    <div class="col-12">
                      <label for="username" class="form-label">Validate Code</label>
                      <div class="input-group">
                        <?php
                        for ($i = 1; $i <= 4; $i++) {
                            echo form_input('code[]', '', 'class="form-control verify-code text-center border-bold font-weight-bold rounded-lg" maxlength="1" style="font-size: 24px;" required');
                        }
                        ?>
                      </div>
                      <div class="invalid-feedback">Please enter the validation code.</div>
                    </div>

                    <div class="col-12">
                      <?= form_submit('submit', 'Validate', ['class' => 'btn btn-primary w-100']) ?>
                    </div>

                </form>
                
                </div>
              </div>

            </div>
        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        var inputs = $('.verify-code');
        inputs.on('input', function() {
            var currentIndex = inputs.index(this);
            var inputValue = $(this).val();

            if (inputValue.length === 1 && currentIndex < inputs.length - 1) {
                inputs.eq(currentIndex + 1).focus();
            }
        })
    });
</script>

<?= $this->endSection() ?>