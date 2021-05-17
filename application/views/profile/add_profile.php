<div class="m-grid__item m-grid__item--fluid m-wrapper">
  <!-- BEGIN: Subheader -->
  <div class="m-subheader ">
    <div class="d-flex align-items-center">
      <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator">
          <?= $title ?>
        </h3>
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
          <li class="m-nav__item m-nav__item--home">
            <a href="#" class="m-nav__link m-nav__link--icon">
              <i class="m-nav__link-icon la la-home"></i>
            </a>
          </li>
          <li class="m-nav__separator">
            -
          </li>
          <li class="m-nav__item">
            <a href="<?=base_url()?>dashboard" class="m-nav__link">
              <span class="m-nav__link-text">
                Dashboard
              </span>
            </a>
          </li>
          <li class="m-nav__separator">
            -
          </li>
          <li class="m-nav__item">
            <a href="<?=base_url()?>add_commission" class="m-nav__link">
              <span class="m-nav__link-text">
                Create Product Commission
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>



  <!-- END: Subheader -->
  <div class="m-content">
    <?= $this->session->flashdata('message');?>
    <div class="row">
      <div class="col-lg-12">
        <div class="m-portlet">
          <!--begin::Form-->
          <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="<?= base_url()?>Commission/add_commission" autocomplete="off">
            <div class="m-portlet__body">
              <div class="form-group m-form__group row">
                <div class="col-lg-4">
                  <label class="">
                    Contract:
                  </label>
                  <select class="form-control m-select m_select2" name="contract" required>
                    <option value="">Select Option</option>
                    <?php foreach($contract as $value){ ?>
                      <option value="<?=$value->id?>"><?=$value->contract_name?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-lg-4">
                  <label>
                    Commission Name:
                  </label>
                  <input type="text" class="form-control m-input" placeholder="Enter Commission Name" name="commission" required>
                </div>
              </div>
              <div class="form-group m-form__group row">
                
                <div class="col-lg-4">
                  <label>
                    Products:
                  </label>
                  <select class="form-control m-select m_select2" name="product[]" multiple="multiple" required>
                    <option value="">Select Option</option>
                    <?php foreach($product as $value){ ?>
                      <option value="<?=$value->id?>"><?=$value->name?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
              <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                  <div class="col-lg-6">
                    <button type="submit" id="save" class="btn btn-success">
                      Save
                    </button>
                    <button type="reset" class="btn btn-secondary">
                      Cancel
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!--end::Form-->
        </div>
      </div>
    </div>
  </div>
</div>
</div>
