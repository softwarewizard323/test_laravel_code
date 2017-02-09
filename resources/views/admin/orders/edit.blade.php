@extends('admin.layouts.app')

@section('breadcrumb')
@stop

@section('content')

    <!-- Main window -->
    <div class="main_container" id="msgRead_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span10">
                <div class="widget-header">
                    <i class="icon-edit"></i>
                    <h5>Edit Order <b>#{{ $order['order_id'] }}</b> ordered <b>{{ date('d-m-Y', strtotime($order['date'])) }}</b>.</h5>
                    <div class="widget-buttons">
                        <a class="btn" href="{{ URL::previous() }}" style="margin:-5px 0 0 0;"><i class="icon-backward"></i></a>
                    </div>
                </div>
                <div class="widget-body">
                    <form action="{{ url('/admin/orders/update/edit', ['id' => $order['order_id']]) }}" method="post" name="form1" id="form1" class="form-horizontal" >
                        {{ csrf_field() }}
                        <input type="hidden" name="date" value="{{ $order['date'] }} " size="32" />
                        <div class="tab-content">
                            <div class="control-group">
                                <label class="control-label">User</label>
                                <div class="controls">
                                    <input class="span3" type="text" name="username" value="{{ $order['username'] }}" readonly />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Date campaign started</label>
                                <div class="controls">
                                    <input type="date" name="date" value="{{ date('Y-m-d', strtotime($order['date'])) }}" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Source</label>
                                <div class="controls">
                                    <select name="source" id="select2-basic" class="span7">
                                        @foreach($sources as $source)
                                        <option value="{{ $source['source_id'] }}" @if ($source['source_id'] == $order['source']) selected @endif>{{ $source['source_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Country</label>
                                <div class="controls">
                                    {{-- OMG !!! WTF !!! Sorry, no time to refactoring !!! --}}
                                    <select name="country" id="select2-basic" class="span7">
                                        <option value="All Countries" <?php if (!(strcmp("All Countries", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>All Countries</option>
                                        <option value="Afghanistan" <?php if (!(strcmp("Afghanistan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Afghanistan</option>
                                        <option value="Aland Islands" <?php if (!(strcmp("Aland Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Aland Islands</option>
                                        <option value="Albania" <?php if (!(strcmp("Albania", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Albania</option>
                                        <option value="Algeria" <?php if (!(strcmp("Algeria", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Algeria</option>
                                        <option value="American Samoa" <?php if (!(strcmp("American Samoa", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>American Samoa</option>
                                        <option value="Andorra" <?php if (!(strcmp("Andorra", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Andorra</option>
                                        <option value="Angola" <?php if (!(strcmp("Angola", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Angola</option>
                                        <option value="Anguilla" <?php if (!(strcmp("Anguilla", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Anguilla</option>
                                        <option value="Antarctica" <?php if (!(strcmp("Antarctica", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Antarctica</option>
                                        <option value="Antigua and Barbuda" <?php if (!(strcmp("Antigua and Barbuda", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Antigua and Barbuda</option>
                                        <option value="Argentina" <?php if (!(strcmp("Argentina", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Argentina</option>
                                        <option value="Armenia" <?php if (!(strcmp("Armenia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Armenia</option>
                                        <option value="Aruba" <?php if (!(strcmp("Aruba", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Aruba</option>
                                        <option value="Australia" <?php if (!(strcmp("Australia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Australia</option>
                                        <option value="Austria" <?php if (!(strcmp("Austria", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Austria</option>
                                        <option value="Azerbaijan" <?php if (!(strcmp("Azerbaijan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Azerbaijan</option>
                                        <option value="Bahamas" <?php if (!(strcmp("Bahamas", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Bahamas</option>
                                        <option value="Bahrain" <?php if (!(strcmp("Bahrain", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Bahrain</option>
                                        <option value="Bangladesh" <?php if (!(strcmp("Bangladesh", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Bangladesh</option>
                                        <option value="Barbados" <?php if (!(strcmp("Barbados", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Barbados</option>
                                        <option value="Belarus" <?php if (!(strcmp("Belarus", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Belarus</option>
                                        <option value="Belgium" <?php if (!(strcmp("Belgium", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Belgium</option>
                                        <option value="Belize" <?php if (!(strcmp("Belize", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Belize</option>
                                        <option value="Benin" <?php if (!(strcmp("Benin", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Benin</option>
                                        <option value="Bermuda" <?php if (!(strcmp("Bermuda", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Bermuda</option>
                                        <option value="Bhutan" <?php if (!(strcmp("Bhutan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Bhutan</option>
                                        <option value="Bolivia" <?php if (!(strcmp("Bolivia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Bolivia</option>
                                        <option value="Bosnia and Herzegovina" <?php if (!(strcmp("Bosnia and Herzegovina", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Bosnia and Herzegovina</option>
                                        <option value="Botswana" <?php if (!(strcmp("Botswana", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Botswana</option>
                                        <option value="Bouvet Island" <?php if (!(strcmp("Bouvet Island", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Bouvet Island</option>
                                        <option value="Brazil" <?php if (!(strcmp("Brazil", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Brazil</option>
                                        <option value="British Indian Ocean Territory" <?php if (!(strcmp("British Indian Ocean Territory", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam" <?php if (!(strcmp("Brunei Darussalam", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Brunei Darussalam</option>
                                        <option value="Bulgaria" <?php if (!(strcmp("Bulgaria", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Bulgaria</option>
                                        <option value="Burkina Faso" <?php if (!(strcmp("Burkina Faso", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Burkina Faso</option>
                                        <option value="Burundi" <?php if (!(strcmp("Burundi", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Burundi</option>
                                        <option value="Cambodia" <?php if (!(strcmp("Cambodia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Cambodia</option>
                                        <option value="Cameroon" <?php if (!(strcmp("Cameroon", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Cameroon</option>
                                        <option value="Canada" <?php if (!(strcmp("Canada", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Canada</option>
                                        <option value="Cape Verde" <?php if (!(strcmp("Cape Verde", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Cape Verde</option>
                                        <option value="Cayman Islands" <?php if (!(strcmp("Cayman Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Cayman Islands</option>
                                        <option value="Central African Republic" <?php if (!(strcmp("Central African Republic", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Central African Republic</option>
                                        <option value="Chad" <?php if (!(strcmp("Chad", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Chad</option>
                                        <option value="Chile" <?php if (!(strcmp("Chile", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Chile</option>
                                        <option value="China" <?php if (!(strcmp("China", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>China</option>
                                        <option value="Christmas Island" <?php if (!(strcmp("Christmas Island", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands" <?php if (!(strcmp("Cocos (Keeling) Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Cocos (Keeling) Islands</option>
                                        <option value="Colombia" <?php if (!(strcmp("Colombia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Colombia</option>
                                        <option value="Comoros" <?php if (!(strcmp("Comoros", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Comoros</option>
                                        <option value="Congo" <?php if (!(strcmp("Congo", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Congo</option>
                                        <option value="Congo, The Democratic Republic of The" <?php if (!(strcmp("Congo, The Democratic Republic of The", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands" <?php if (!(strcmp("Cook Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Cook Islands</option>
                                        <option value="Costa Rica" <?php if (!(strcmp("Costa Rica", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Costa Rica</option>
                                        <option value="Cote Divoire" <?php if (!(strcmp("Cote Divoire", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Cote Divoire</option>
                                        <option value="Croatia" <?php if (!(strcmp("Croatia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Croatia</option>
                                        <option value="Cuba" <?php if (!(strcmp("Cuba", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Cuba</option>
                                        <option value="Cyprus" <?php if (!(strcmp("Cyprus", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Cyprus</option>
                                        <option value="Czech Republic" <?php if (!(strcmp("Czech Republic", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Czech Republic</option>
                                        <option value="Denmark" <?php if (!(strcmp("Denmark", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Denmark</option>
                                        <option value="Djibouti" <?php if (!(strcmp("Djibouti", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Djibouti</option>
                                        <option value="Dominica" <?php if (!(strcmp("Dominica", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Dominica</option>
                                        <option value="Dominican Republic" <?php if (!(strcmp("Dominican Republic", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Dominican Republic</option>
                                        <option value="Ecuador" <?php if (!(strcmp("Ecuador", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Ecuador</option>
                                        <option value="Egypt" <?php if (!(strcmp("Egypt", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Egypt</option>
                                        <option value="El Salvador" <?php if (!(strcmp("El Salvador", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>El Salvador</option>
                                        <option value="Equatorial Guinea" <?php if (!(strcmp("Equatorial Guinea", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Equatorial Guinea</option>
                                        <option value="Eritrea" <?php if (!(strcmp("Eritrea", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Eritrea</option>
                                        <option value="Estonia" <?php if (!(strcmp("Estonia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Estonia</option>
                                        <option value="Ethiopia" <?php if (!(strcmp("Ethiopia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)" <?php if (!(strcmp("Falkland Islands (Malvinas)", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands" <?php if (!(strcmp("Faroe Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Faroe Islands</option>
                                        <option value="Fiji" <?php if (!(strcmp("Fiji", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Fiji</option>
                                        <option value="Finland" <?php if (!(strcmp("Finland", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Finland</option>
                                        <option value="France" <?php if (!(strcmp("France", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>France</option>
                                        <option value="French Guiana" <?php if (!(strcmp("French Guiana", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>French Guiana</option>
                                        <option value="French Polynesia" <?php if (!(strcmp("French Polynesia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>French Polynesia</option>
                                        <option value="French Southern Territories" <?php if (!(strcmp("French Southern Territories", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>French Southern Territories</option>
                                        <option value="Gabon" <?php if (!(strcmp("Gabon", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Gabon</option>
                                        <option value="Gambia" <?php if (!(strcmp("Gambia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Gambia</option>
                                        <option value="Georgia" <?php if (!(strcmp("Georgia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Georgia</option>
                                        <option value="Germany" <?php if (!(strcmp("Germany", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Germany</option>
                                        <option value="Ghana" <?php if (!(strcmp("Ghana", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Ghana</option>
                                        <option value="Gibraltar" <?php if (!(strcmp("Gibraltar", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Gibraltar</option>
                                        <option value="Greece" <?php if (!(strcmp("Greece", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Greece</option>
                                        <option value="Greenland" <?php if (!(strcmp("Greenland", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Greenland</option>
                                        <option value="Grenada" <?php if (!(strcmp("Grenada", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Grenada</option>
                                        <option value="Guadeloupe" <?php if (!(strcmp("Guadeloupe", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Guadeloupe</option>
                                        <option value="Guam" <?php if (!(strcmp("Guam", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Guam</option>
                                        <option value="Guatemala" <?php if (!(strcmp("Guatemala", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Guatemala</option>
                                        <option value="Guernsey" <?php if (!(strcmp("Guernsey", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Guernsey</option>
                                        <option value="Guinea" <?php if (!(strcmp("Guinea", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Guinea</option>
                                        <option value="Guinea-bissau" <?php if (!(strcmp("Guinea-bissau", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Guinea-bissau</option>
                                        <option value="Guyana" <?php if (!(strcmp("Guyana", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Guyana</option>
                                        <option value="Haiti" <?php if (!(strcmp("Haiti", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands" <?php if (!(strcmp("Heard Island and Mcdonald Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)" <?php if (!(strcmp("Holy See (Vatican City State)", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Holy See (Vatican City State)</option>
                                        <option value="Honduras" <?php if (!(strcmp("Honduras", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Honduras</option>
                                        <option value="Hong Kong" <?php if (!(strcmp("Hong Kong", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Hong Kong</option>
                                        <option value="Hungary" <?php if (!(strcmp("Hungary", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Hungary</option>
                                        <option value="Iceland" <?php if (!(strcmp("Iceland", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Iceland</option>
                                        <option value="India" <?php if (!(strcmp("India", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>India</option>
                                        <option value="Indonesia" <?php if (!(strcmp("Indonesia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Indonesia</option>
                                        <option value="Iran, Islamic Republic of" <?php if (!(strcmp("Iran, Islamic Republic of", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Iran, Islamic Republic of</option>
                                        <option value="Iraq" <?php if (!(strcmp("Iraq", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Iraq</option>
                                        <option value="Ireland" <?php if (!(strcmp("Ireland", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Ireland</option>
                                        <option value="Isle of Man" <?php if (!(strcmp("Isle of Man", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Isle of Man</option>
                                        <option value="Israel" <?php if (!(strcmp("Israel", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Israel</option>
                                        <option value="Italy" <?php if (!(strcmp("Italy", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Italy</option>
                                        <option value="Jamaica" <?php if (!(strcmp("Jamaica", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Jamaica</option>
                                        <option value="Japan" <?php if (!(strcmp("Japan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Japan</option>
                                        <option value="Jersey" <?php if (!(strcmp("Jersey", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Jersey</option>
                                        <option value="Jordan" <?php if (!(strcmp("Jordan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Jordan</option>
                                        <option value="Kazakhstan" <?php if (!(strcmp("Kazakhstan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Kazakhstan</option>
                                        <option value="Kenya" <?php if (!(strcmp("Kenya", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Kenya</option>
                                        <option value="Kiribati" <?php if (!(strcmp("Kiribati", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Kiribati</option>
                                        <option value="Korea, Democratic Peoples Republic of" <?php if (!(strcmp("Korea, Democratic Peoples Republic of", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of" <?php if (!(strcmp("Korea, Republic of", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Korea, Republic of</option>
                                        <option value="Kuwait" <?php if (!(strcmp("Kuwait", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Kuwait</option>
                                        <option value="Kyrgyzstan" <?php if (!(strcmp("Kyrgyzstan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Kyrgyzstan</option>
                                        <option value="Lao Peoples Democratic Republic" <?php if (!(strcmp("Lao Peoples Democratic Republic", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Lao People's Democratic Republic</option>
                                        <option value="Latvia" <?php if (!(strcmp("Latvia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Latvia</option>
                                        <option value="Lebanon" <?php if (!(strcmp("Lebanon", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Lebanon</option>
                                        <option value="Lesotho" <?php if (!(strcmp("Lesotho", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Lesotho</option>
                                        <option value="Liberia" <?php if (!(strcmp("Liberia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Liberia</option>
                                        <option value="Libyan Arab Jamahiriya" <?php if (!(strcmp("Libyan Arab Jamahiriya", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein" <?php if (!(strcmp("Liechtenstein", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Liechtenstein</option>
                                        <option value="Lithuania" <?php if (!(strcmp("Lithuania", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Lithuania</option>
                                        <option value="Luxembourg" <?php if (!(strcmp("Luxembourg", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Luxembourg</option>
                                        <option value="Macao" <?php if (!(strcmp("Macao", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of" <?php if (!(strcmp("Macedonia, The Former Yugoslav Republic of", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar" <?php if (!(strcmp("Madagascar", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Madagascar</option>
                                        <option value="Malawi" <?php if (!(strcmp("Malawi", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Malawi</option>
                                        <option value="Malaysia" <?php if (!(strcmp("Malaysia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Malaysia</option>
                                        <option value="Maldives" <?php if (!(strcmp("Maldives", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Maldives</option>
                                        <option value="Mali" <?php if (!(strcmp("Mali", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Mali</option>
                                        <option value="Malta" <?php if (!(strcmp("Malta", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Malta</option>
                                        <option value="Marshall Islands" <?php if (!(strcmp("Marshall Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Marshall Islands</option>
                                        <option value="Martinique" <?php if (!(strcmp("Martinique", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Martinique</option>
                                        <option value="Mauritania" <?php if (!(strcmp("Mauritania", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Mauritania</option>
                                        <option value="Mauritius" <?php if (!(strcmp("Mauritius", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Mauritius</option>
                                        <option value="Mayotte" <?php if (!(strcmp("Mayotte", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Mayotte</option>
                                        <option value="Mexico" <?php if (!(strcmp("Mexico", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Mexico</option>
                                        <option value="Micronesia, Federated States of" <?php if (!(strcmp("Micronesia, Federated States of", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of" <?php if (!(strcmp("Moldova, Republic of", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Moldova, Republic of</option>
                                        <option value="Monaco" <?php if (!(strcmp("Monaco", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Monaco</option>
                                        <option value="Mongolia" <?php if (!(strcmp("Mongolia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Mongolia</option>
                                        <option value="Montenegro" <?php if (!(strcmp("Montenegro", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Montenegro</option>
                                        <option value="Montserrat" <?php if (!(strcmp("Montserrat", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Montserrat</option>
                                        <option value="Morocco" <?php if (!(strcmp("Morocco", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Morocco</option>
                                        <option value="Mozambique" <?php if (!(strcmp("Mozambique", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Mozambique</option>
                                        <option value="Myanmar" <?php if (!(strcmp("Myanmar", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Myanmar</option>
                                        <option value="Namibia" <?php if (!(strcmp("Namibia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Namibia</option>
                                        <option value="Nauru" <?php if (!(strcmp("Nauru", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Nauru</option>
                                        <option value="Nepal" <?php if (!(strcmp("Nepal", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Nepal</option>
                                        <option value="Netherlands" <?php if (!(strcmp("Netherlands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Netherlands</option>
                                        <option value="Netherlands Antilles" <?php if (!(strcmp("Netherlands Antilles", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Netherlands Antilles</option>
                                        <option value="New Caledonia" <?php if (!(strcmp("New Caledonia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>New Caledonia</option>
                                        <option value="New Zealand" <?php if (!(strcmp("New Zealand", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>New Zealand</option>
                                        <option value="Nicaragua" <?php if (!(strcmp("Nicaragua", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Nicaragua</option>
                                        <option value="Niger" <?php if (!(strcmp("Niger", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Niger</option>
                                        <option value="Nigeria" <?php if (!(strcmp("Nigeria", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Nigeria</option>
                                        <option value="Niue" <?php if (!(strcmp("Niue", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Niue</option>
                                        <option value="Norfolk Island" <?php if (!(strcmp("Norfolk Island", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Norfolk Island</option>
                                        <option value="Northern Mariana Islands" <?php if (!(strcmp("Northern Mariana Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Northern Mariana Islands</option>
                                        <option value="Norway" <?php if (!(strcmp("Norway", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Norway</option>
                                        <option value="Oman" <?php if (!(strcmp("Oman", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Oman</option>
                                        <option value="Pakistan" <?php if (!(strcmp("Pakistan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Pakistan</option>
                                        <option value="Palau" <?php if (!(strcmp("Palau", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Palau</option>
                                        <option value="Palestinian Territory, Occupied" <?php if (!(strcmp("Palestinian Territory, Occupied", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Palestinian Territory, Occupied</option>
                                        <option value="Panama" <?php if (!(strcmp("Panama", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Panama</option>
                                        <option value="Papua New Guinea" <?php if (!(strcmp("Papua New Guinea", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Papua New Guinea</option>
                                        <option value="Paraguay" <?php if (!(strcmp("Paraguay", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Paraguay</option>
                                        <option value="Peru" <?php if (!(strcmp("Peru", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Peru</option>
                                        <option value="Philippines" <?php if (!(strcmp("Philippines", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Philippines</option>
                                        <option value="Pitcairn" <?php if (!(strcmp("Pitcairn", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Pitcairn</option>
                                        <option value="Poland" <?php if (!(strcmp("Poland", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Poland</option>
                                        <option value="Portugal" <?php if (!(strcmp("Portugal", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Portugal</option>
                                        <option value="Puerto Rico" <?php if (!(strcmp("Puerto Rico", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Puerto Rico</option>
                                        <option value="Qatar" <?php if (!(strcmp("Qatar", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Qatar</option>
                                        <option value="Reunion" <?php if (!(strcmp("Reunion", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Reunion</option>
                                        <option value="Romania" <?php if (!(strcmp("Romania", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Romania</option>
                                        <option value="Russian Federation" <?php if (!(strcmp("Russian Federation", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Russian Federation</option>
                                        <option value="Rwanda" <?php if (!(strcmp("Rwanda", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Rwanda</option>
                                        <option value="Saint Helena" <?php if (!(strcmp("Saint Helena", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Saint Helena</option>
                                        <option value="Saint Kitts and Nevis" <?php if (!(strcmp("Saint Kitts and Nevis", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia" <?php if (!(strcmp("Saint Lucia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon" <?php if (!(strcmp("Saint Pierre and Miquelon", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines" <?php if (!(strcmp("Saint Vincent and The Grenadines", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Saint Vincent and The Grenadines</option>
                                        <option value="Samoa" <?php if (!(strcmp("Samoa", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Samoa</option>
                                        <option value="San Marino" <?php if (!(strcmp("San Marino", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>San Marino</option>
                                        <option value="Sao Tome and Principe" <?php if (!(strcmp("Sao Tome and Principe", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Sao Tome and Principe</option>
                                        <option value="Saudi Arabia" <?php if (!(strcmp("Saudi Arabia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Saudi Arabia</option>
                                        <option value="Senegal" <?php if (!(strcmp("Senegal", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Senegal</option>
                                        <option value="Serbia" <?php if (!(strcmp("Serbia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Serbia</option>
                                        <option value="Seychelles" <?php if (!(strcmp("Seychelles", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Seychelles</option>
                                        <option value="Sierra Leone" <?php if (!(strcmp("Sierra Leone", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Sierra Leone</option>
                                        <option value="Singapore" <?php if (!(strcmp("Singapore", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Singapore</option>
                                        <option value="Slovakia" <?php if (!(strcmp("Slovakia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Slovakia</option>
                                        <option value="Slovenia" <?php if (!(strcmp("Slovenia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Slovenia</option>
                                        <option value="Solomon Islands" <?php if (!(strcmp("Solomon Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Solomon Islands</option>
                                        <option value="Somalia" <?php if (!(strcmp("Somalia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Somalia</option>
                                        <option value="South Africa" <?php if (!(strcmp("South Africa", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands" <?php if (!(strcmp("South Georgia and The South Sandwich Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain" <?php if (!(strcmp("Spain", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Spain</option>
                                        <option value="Sri Lanka" <?php if (!(strcmp("Sri Lanka", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Sri Lanka</option>
                                        <option value="Sudan" <?php if (!(strcmp("Sudan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Sudan</option>
                                        <option value="Suriname" <?php if (!(strcmp("Suriname", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Suriname</option>
                                        <option value="Svalbard and Jan Mayen" <?php if (!(strcmp("Svalbard and Jan Mayen", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Svalbard and Jan Mayen</option>
                                        <option value="Swaziland" <?php if (!(strcmp("Swaziland", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Swaziland</option>
                                        <option value="Sweden" <?php if (!(strcmp("Sweden", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Sweden</option>
                                        <option value="Switzerland" <?php if (!(strcmp("Switzerland", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Switzerland</option>
                                        <option value="Syrian Arab Republic" <?php if (!(strcmp("Syrian Arab Republic", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China" <?php if (!(strcmp("Taiwan, Province of China", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Taiwan, Province of China</option>
                                        <option value="Tajikistan" <?php if (!(strcmp("Tajikistan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Tajikistan</option>
                                        <option value="Tanzania, United Republic of" <?php if (!(strcmp("Tanzania, United Republic of", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Tanzania, United Republic of</option>
                                        <option value="Thailand" <?php if (!(strcmp("Thailand", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Thailand</option>
                                        <option value="Timor-leste" <?php if (!(strcmp("Timor-leste", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Timor-leste</option>
                                        <option value="Togo" <?php if (!(strcmp("Togo", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Togo</option>
                                        <option value="Tokelau" <?php if (!(strcmp("Tokelau", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Tokelau</option>
                                        <option value="Tonga" <?php if (!(strcmp("Tonga", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Tonga</option>
                                        <option value="Trinidad and Tobago" <?php if (!(strcmp("Trinidad and Tobago", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Trinidad and Tobago</option>
                                        <option value="Tunisia" <?php if (!(strcmp("Tunisia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Tunisia</option>
                                        <option value="Turkey" <?php if (!(strcmp("Turkey", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Turkey</option>
                                        <option value="Turkmenistan" <?php if (!(strcmp("Turkmenistan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Turkmenistan</option>
                                        <option value="Turks and Caicos Islands" <?php if (!(strcmp("Turks and Caicos Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Turks and Caicos Islands</option>
                                        <option value="Tuvalu" <?php if (!(strcmp("Tuvalu", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Tuvalu</option>
                                        <option value="Uganda" <?php if (!(strcmp("Uganda", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Uganda</option>
                                        <option value="Ukraine" <?php if (!(strcmp("Ukraine", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Ukraine</option>
                                        <option value="United Arab Emirates" <?php if (!(strcmp("United Arab Emirates", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>United Arab Emirates</option>
                                        <option value="United Kingdom" <?php if (!(strcmp("United Kingdom", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>United Kingdom</option>
                                        <option value="United States" <?php if (!(strcmp("United States", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>United States</option>
                                        <option value="United States Minor Outlying Islands" <?php if (!(strcmp("United States Minor Outlying Islands", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>United States Minor Outlying Islands</option>
                                        <option value="Uruguay" <?php if (!(strcmp("Uruguay", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Uruguay</option>
                                        <option value="Uzbekistan" <?php if (!(strcmp("Uzbekistan", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Uzbekistan</option>
                                        <option value="Vanuatu" <?php if (!(strcmp("Vanuatu", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Vanuatu</option>
                                        <option value="Venezuela" <?php if (!(strcmp("Venezuela", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Venezuela</option>
                                        <option value="Viet Nam" <?php if (!(strcmp("Viet Nam", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Viet Nam</option>
                                        <option value="Virgin Islands, British" <?php if (!(strcmp("Virgin Islands, British", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S." <?php if (!(strcmp("Virgin Islands, U.S.", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna" <?php if (!(strcmp("Wallis and Futuna", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Wallis and Futuna</option>
                                        <option value="Western Sahara" <?php if (!(strcmp("Western Sahara", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Western Sahara</option>
                                        <option value="Yemen" <?php if (!(strcmp("Yemen", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Yemen</option>
                                        <option value="Zambia" <?php if (!(strcmp("Zambia", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Zambia</option>
                                        <option value="Zimbabwe" <?php if (!(strcmp("Zimbabwe", htmlspecialchars($order['country'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>Zimbabwe</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">URL</label>
                                <div class="controls">
                                    <input type="text" name="website" value="{{ $order['website'] }}" class="span7" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Keywords</label>
                                <div class="controls">
                                    <input type="text" id="wizard_tags" name="keywords" value="{{ $order['keywords'] }}" class="span7" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Visitors per keywords</label>
                                <div class="controls">
                                    <input type="text" id="wizard_tags" name="quantity" value="{{ $order['quantity'] }}" class="span7" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Total Visitors</label>
                                <div class="controls">
                                    <input type="text" id="wizard_tags" name="total_quantity" value="{{ $order['total_quantity'] }}" class="span7" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Daily $ spendings</label>
                                <div class="controls">
                                    <input type="text" id="wizard_tags" name="price" value="{{ $order['price'] }}" class="span7" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Booster Type</label>
                                <div class="controls">
                                    <select name="type" class="span4">
                                        <option value="Google" @if ($order['type'] == 'Google') selected @endif>Google Traffic</option>
                                        <option value="Direct" @if ($order['type'] == 'Direct') selected @endif>Direct Traffic</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Campaign Status</label>
                                <div class="controls">
                                    <select name="status" id="select2-basic" class="span4">
                                        <option value="1" @if ($order['status'] == '1') selected @endif>Active</option>
                                        <option value="0" @if ($order['status'] == '0') selected @endif>Pending</option>
                                        <option value="3" @if ($order['status'] == '3') selected @endif>Completed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <input type="submit" value="Update Order" class="btn btn-small btn-primary" />
                                </div>
                            </div>

                            <input type="hidden" name="previous_page" value="{{ URL::previous() }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- END widget-body -->
    </div><!-- END row-fluid -->

@stop