<div class="modalRename" id="modalRename">
	<div >
		
		<div class="close">
			<button class="btnclosemodal" id="btnCloseModal">
				x
			</button>
		</div>

		<div class="form">
			<div class="header">
				<span>
					{{ trans('mifilemanager::mifm.mc-mdl-rn') }}
				</span>
			</div>
			<div class="body">
				<div>
					<p>
						{{ trans('mifilemanager::mifm.mc-mdl-rn-in') }}
					</p>
				</div>
				<form action="">
					<input type="text" name="name">
				</form>
			</div>
			<div class="footer">
				<button id="btnSave">{{ trans('mifilemanager::mifm.mc-save') }}</button>
				<button id="btnCancel">{{ trans('mifilemanager::mifm.mc-cancel') }}</button>
			</div>
		</div>

	</div>
</div>