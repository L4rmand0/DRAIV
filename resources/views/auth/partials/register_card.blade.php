<div class="card-body">
    <form id="msform">
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active" id="account"></i><strong>Cuenta</strong></li>
            <li id="personal"><strong>Resumen</strong></li>
            <li id="confirm"><strong>Confirmación</strong></li>
        </ul>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                aria-valuemin="0" aria-valuemax="100"></div>
        </div> <hr> <!-- fieldsets -->
        <h2 id="heading">Regístrese para una Cuenta DRAIV</h2>
        <label class="text-center mb-3 mt-2 ml-5"
            style="color: #979797; font-size: 1.1em; font-family: 'Fira Sans', sans-serif;" for="">¿Ya
            tiene
            una cuenta DRAIV? <a
                style="color:#1A8ED1; cursor: pointer; font-size: 1.1em; font-family: 'Fira Sans', sans-serif;"
                id="btn_call_login" class="btn btn-link">
                {{ __('Iniciar Sesión') }}
            </a></label>
        <fieldset>
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Información de cuenta:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Paso 1 - 4</h2>
                    </div>
                </div> <label class="fieldlabels">Email: *</label> <input type="email" name="email"
                    placeholder="Email Id" /> <label class="fieldlabels">Username:
                    *</label> <input type="text" name="uname" placeholder="UserName" /> <label
                    class="fieldlabels">Password: *</label> <input type="password" name="pwd"
                    placeholder="Password" /> <label class="fieldlabels">Confirm Password:
                    *</label> <input type="password" name="cpwd" placeholder="Confirm Password" />
            </div> <input type="button" name="next" class="next action-button" value="Siguiente" />
        </fieldset>
        <fieldset>
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Personal Information:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Step 2 - 4</h2>
                    </div>
                </div> <label class="fieldlabels">First Name: *</label> <input type="text" name="fname"
                    placeholder="First Name" /> <label class="fieldlabels">Last
                    Name: *</label> <input type="text" name="lname" placeholder="Last Name" />
                <label class="fieldlabels">Contact No.: *</label> <input type="text" name="phno"
                    placeholder="Contact No." /> <label class="fieldlabels">Alternate Contact
                    No.: *</label> <input type="text" name="phno_2"
                    placeholder="Alternate Contact No." />
            </div> <input type="button" name="next" class="next action-button" value="Next" />
            <input type="button" name="previous" class="previous action-button-previous"
                value="Previous" />
        </fieldset>
        <fieldset>
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Image Upload:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Step 3 - 4</h2>
                    </div>
                </div> <label class="fieldlabels">Upload Your Photo:</label> <input type="file"
                    name="pic" accept="image/*"> <label class="fieldlabels">Upload Signature
                    Photo:</label> <input type="file" name="pic" accept="image/*">
            </div> <input type="button" name="next" class="next action-button" value="Submit" />
            <input type="button" name="previous" class="previous action-button-previous"
                value="Previous" />
        </fieldset>
        <fieldset>
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Finish:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Step 4 - 4</h2>
                    </div>
                </div> <br><br>
                <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                <div class="row justify-content-center">
                    <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image">
                    </div>
                </div> <br><br>
                <div class="row justify-content-center">
                    <div class="col-7 text-center">
                        <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>