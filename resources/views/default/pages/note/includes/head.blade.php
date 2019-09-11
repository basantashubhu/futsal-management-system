<!-- BEGIN: Subheader -->
<div class="m-subheader">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Note
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
                    <a href="#" data-route="lookup" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Settings
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="#" data-route="note" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Note
                        </span>
                    </a>
                </li>
            </ul>
		</div>

        <button class="btn btn-default m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill notes-back mr-15" data-route="note" style="display: none;">
            <span>
                <i class="la la-arrow-left"></i>
                <span>
                    Back
                </span>
            </span>
        </button>

         <button class="btn btn-info m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill" data-modal-route="/addNote" data-backdrop="static" data-keyboard="false">
            <span>
                <i class="la la-plus"></i>
                <span>
                    Note
                </span>
            </span>
        </button>
	</div>
</div>
<!-- END: Subheader -->