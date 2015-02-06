<?php 

// Include code for making remote connection
include('XMLTransactionHander.class.php'); 


// Process Response

// Client settings
$clientID = '84'; // 本地代碼 : 提供
$email = 'XML@IHBC.COM.TW'; // 郵件 : 提供 roger@ihbc.com.tw
$password = 'PASS'; // 密碼 : 提供 ihbc54617220
$language = 'en'; // 語系
$requestMode =  'SYNCHRONOUS'; //'ASYNCHRONOUS'; // 請求模式
// 請求返回網址
$responseCallbackURL =  'http://localhost/hotel/CallbackResponseHandler.php'; // 'http://localhost/php/CallbackResponseHandler.php';

// Build Search Request Data
$destinationType = 'city'; //'city'; // 區域類別 : city / area
$destinationCode = 'lon'; //'lon'; // 目的地代碼
$checkinDate = date('Y-m-d',strtotime(date('Y-m-d H:i:s').' +7 day')); // '2006-05-10'; 訂房日期
$duration = '2'; //'2'; 入住天數
$roomCode = 'ts'; //'db'; 房間代碼 : DB / TB / SB
$numberOfRooms = '2'; //'1'; 房間數



/**********************************************************/
/** String concatenation example of building XML Request **/
/**********************************************************/
$requestData = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
$requestData .= '<Request>';

// Create Request Header
$requestData .= '<Source>';

// Add Requestor ID data
$requestData .= '<RequestorID Client="'.$clientID.'" EMailAddress="'.$email.'" Password="'.$password.'"/>';

// Add Requestor Preferences data
$requestData .= '<RequestorPreferences Language="'.$language.'" Country = "DE" Currency = "EUR">';
$requestData .= '<RequestMode>'.$requestMode.'</RequestMode>';
/*** UNCOMMENT IF USING ASYNCHRONOUS Callback Mode ***/
#$requestData .= '<ResponseURL>'.$responseCallbackURL.'</ResponseURL>';
$requestData .= '</RequestorPreferences>';
$requestData .= '</Source>';

// Create Request Body
$requestData .= '<RequestDetails>';
$requestData .= '<SearchHotelPriceRequest>';

// Add destination
$requestData .= '<ItemDestination DestinationType="'.$destinationType.'" DestinationCode="'.$destinationCode.'"/>';

// Add period of stay
$requestData .= '<PeriodOfStay>';
$requestData .= '<CheckInDate>'.$checkinDate.'</CheckInDate>';
$requestData .= '<Duration>'.$duration.'</Duration>';
$requestData .= '</PeriodOfStay>';

// Add rooms
$requestData .= '<Rooms>';
$requestData .= '<Room Code="'.$roomCode.'" NumberOfRooms="'.$numberOfRooms.'"/>';
$requestData .= '</Rooms>';
$requestData .= '</SearchHotelPriceRequest>';
$requestData .= '</RequestDetails>';

$requestData .= '</Request>';

//echo $requestData;




/*********************************************/
/** XML DOM example of building XML Request **/
/*********************************************/
$requestDoc = new DOMDocument('1.0', 'UTF-8');
$requestElement = $requestDoc->appendChild( $requestDoc->createElement('Request') );

// Create Request Header
$sourceElement = $requestElement->appendChild( $requestDoc->createElement('Source') );

// Add Requestor ID data
$requestorIDElement = $sourceElement->appendChild( $requestDoc->createElement('RequestorID') );
$requestorIDElement->setAttribute( 'Client', $clientID );
$requestorIDElement->setAttribute( 'EMailAddress', $email );
$requestorIDElement->setAttribute( 'Password', $password );

// Add Requestor Preferences data
$requestorPreferencesElement = $sourceElement->appendChild( $requestDoc->createElement('RequestorPreferences') );
$requestorPreferencesElement->setAttribute( 'Language', $language );
$requestModeElement = $requestorPreferencesElement->appendChild( $requestDoc->createElement('RequestMode') );
$requestModeElement->appendChild( $requestDoc->createTextNode( $requestMode ) );
/*** UNCOMMENT IF USING ASYNCHRONOUS Callback Mode ***/
#$responseURLElement = $requestorPreferencesElement->appendChild( $requestDoc->createElement('ResponseURL') );
#$responseURLElement->appendChild( $requestDoc->createTextNode( $responseCallbackURL ) );

// Create Request Body
$requestDetailsElement = $requestElement->appendChild( $requestDoc->createElement('RequestDetails') );
$hotelPriceRequestElement = $requestDetailsElement->appendChild( $requestDoc->createElement('SearchHotelPriceRequest') );

// Add destination
$itemDestinationElement = $hotelPriceRequestElement->appendChild( $requestDoc->createElement('ItemDestination') );
$itemDestinationElement->setAttribute( 'DestinationType', $destinationType );
$itemDestinationElement->setAttribute( 'DestinationCode', $destinationCode );

// Add period of stay
$periodOfStayElement = $hotelPriceRequestElement->appendChild( $requestDoc->createElement('PeriodOfStay') );
$checkinDateElement = $periodOfStayElement->appendChild( $requestDoc->createElement('CheckInDate') );
$checkinDateElement->appendChild( $requestDoc->createTextNode( $checkinDate ) );
$durationElement = $periodOfStayElement->appendChild( $requestDoc->createElement('Duration') );
$durationElement->appendChild( $requestDoc->createTextNode( $duration ) );

// Add rooms
$roomsElement = $hotelPriceRequestElement->appendChild( $requestDoc->createElement('Rooms') );
$roomElement = $roomsElement->appendChild( $requestDoc->createElement('Room') );
$roomElement->setAttribute( 'Code', $roomCode );
$roomElement->setAttribute( 'NumberOfRooms', $numberOfRooms );

$requestData = $requestDoc->saveXML();
$requestData = '<?xml version="1.0" encoding="UTF-8"?>
<Request>
	<Source>
		<RequestorID Client="84" EMailAddress="XML@IHBC.COM.TW" Password="PASS"/>
		<RequestorPreferences Language="en" Currency="GBP" Country="GB">
			<RequestMode>SYNCHRONOUS</RequestMode>
		</RequestorPreferences>
	</Source>
	<RequestDetails>
		<AddBookingItemRequest>
			<BookingReference ReferenceSource="api">1258</BookingReference>
			<BookingItems>
				<BookingItem ItemType="hotel">
					<ItemReference>1</ItemReference>
					<ItemCity Code="LON" />
					<Item Code="HEN2" />
					<ItemRemarks>
						<ItemRemark Code="LA"/>
					</ItemRemarks>
					<HotelItem>
						<PeriodOfStay>
							<CheckInDate>2015-03-22</CheckInDate>
							<CheckOutDate>2015-03-24</CheckOutDate>
						</PeriodOfStay>
						<HotelRooms>
							<HotelRoom Code="DB" Id="001:HEN4:9730:S9464:10852:45030" ExtraBed="false" SharingBedding="false">
								<PaxIds>
									<PaxId>1</PaxId>
									<PaxId>2</PaxId>
								</PaxIds>
							</HotelRoom>
						</HotelRooms>
					</HotelItem>
				</BookingItem>
			</BookingItems>
		</AddBookingItemRequest>
	</RequestDetails>
</Request>';

/*
// 找旅館價格******************************************************************************************************************
		<SearchHotelPriceRequest>
			<ItemDestination DestinationType="city" DestinationCode="LON"/>
			<ImmediateConfirmationOnly />
			<PeriodOfStay>
				<CheckInDate>2015-02-20</CheckInDate>
				<Duration>2</Duration>
			</PeriodOfStay>
			<IncludePriceBreakdown/>
			<Rooms>
				<Room Code="db" NumberOfRooms="1"/>
			</Rooms>
			<OrderBy>pricelowtohigh</OrderBy>
			<NumberOfReturnedItems>1</NumberOfReturnedItems>
		</SearchHotelPriceRequest>
		
// 找所有[國家] 靜態資料******************************************************************************************************************
		<SearchCountryRequest>
			<CountryName></CountryName>
		</SearchCountryRequest>

// 找所有[幣別]	******************************************************************************************************************
		<SearchCurrencyRequest>
			<CurrencyName></CurrencyName>
		</SearchCurrencyRequest>
		
// 找所有指定[國家]所有[城市]******************************************************************************************************************
		<SearchCityRequest CountryCode="GR">
			<CityName></CityName>
		</SearchCityRequest>
// 找所有[區域]******************************************************************************************************************
		<SearchAreaRequest>
			<AreaName></AreaName>
		</SearchAreaRequest>
// 找所有指定[區域]所有[城市]******************************************************************************************************************
		<SearchCitiesInAreaRequest AreaCode="ANA">
			<CityName></CityName>
		</SearchCitiesInAreaRequest>
// 找所有Item ******************************************************************************************************************
// ItemType : apartment(房間) / hotel(旅館) / sightseeing(觀光) / transfer(交通)
// DestinationType 目標類型 : area / city  - DestinationCode 目標類型代碼 : 
		<SearchItemRequest ItemType="hotel">
			<ItemDestination DestinationType="city" DestinationCode="LON" />
			<ItemName></ItemName>
		</SearchItemRequest>
// 找所有 ItemInfomation 詳細資料******************************************************************************************************************
		<SearchItemInformationRequest ItemType="hotel">
			<ItemDestination DestinationType="city" DestinationCode="AMS" />
			<ItemCode></ItemCode>
		</SearchItemInformationRequest>
// 找所有 指定[城市]所有[地區] ******************************************************************************************************************
		<SearchLocationRequest CityCode="HKG" />
// 找所有 房間類別******************************************************************************************************************
		<SearchRoomTypeRequest />
// 找所有 設施******************************************************************************************************************
		<SearchFacilityRequest FacilityType="hotel" >
			<FacilityName></FacilityName>
			<FacilityCode></FacilityCode>
		</SearchFacilityRequest>
// 找所有@@@@@@@
		<SearchSpecialEventRequest>
			<ItemDestination DestinationType="city" DestinationCode="BLQ" />
			<DateRange>
				<FromDate>2004-09-28</FromDate> 
				<ToDate>2004-10-03</ToDate>
			</DateRange>
		</SearchSpecialEventRequest>
// 找所有 膳食類型******************************************************************************************************************
		<SearchMealTypeRequest />
// 找所有 早餐類型******************************************************************************************************************
		<SearchBreakfastTypeRequest />
// 找所有 所有連結******************************************************************************************************************
// LinkType : image/map/flash/richmedia
		<SearchLinkRequest ItemType="hotel" LinkType="image">
			<ItemDestination DestinationType="city" DestinationCode="AMS" />
			<ItemCode>APP</ItemCode>
		</SearchLinkRequest>
// 找所有 備註******************************************************************************************************************
		<SearchRemarkRequest ItemType="hotel">
		  <RemarkName>arrival</RemarkName> 
		</SearchRemarkRequest>
// 找所有 交通轉運清單******************************************************************************************************************
		<SearchTransferListRequest ListType="TransferLocation">
		</SearchTransferListRequest>
// 找指定城市機場******************************************************************************************************************
		<SearchAirportRequest>
			<ItemDestination DestinationType="city" DestinationCode="LON" />
		  <AirportName><![CDATA[at]]></AirportName>
		</SearchAirportRequest>
// 找指定城市車站******************************************************************************************************************
		<SearchStationRequest>
			<ItemDestination DestinationType="city" DestinationCode="LON" />
		  <StationName><![CDATA[liv]]></StationName>
		</SearchStationRequest>
// 找所有 AOT Number******************************************************************************************************************
		<SearchAOTNumberRequest>
			<AssistanceLanguage />
			<Destination>AU</Destination>
			<Nationality>GB</Nationality>
			<ServiceType>hotel</ServiceType>
		</SearchAOTNumberRequest>
// 找所有 特價 @@@@@@@@@@
		<SearchSpecialOfferRequest ItemType="hotel" >
			<PassengerNationality>GB</PassengerNationality>
			<Offer>FNT</Offer>
			<Country>IT</Country>
			<City>ROM</City>
			<Item>AMB</Item>
			<TravelDates>
				<FromDate>2006-06-01</FromDate>
				<ToDate>2006-06-30</ToDate>
			</TravelDates>
			<EffectiveDate>2006-05-01</EffectiveDate>
		</SearchSpecialOfferRequest>	
// 找所有 推薦項目 @@@@@@@
		<SearchRecommendedItemRequest ItemType="hotel" >
			<ItemDestination DestinationType="City" DestinationCode="LON" />
			<Nationality>de</Nationality>
			<TravelDates>
				<FromDate>2015-03-20</FromDate>
				<ToDate>2015-03-28</ToDate>
			</TravelDates>
		</SearchRecommendedItemRequest > 
// 找所有 觀光******************************************************************************************************************
		<SearchSightseeingTypeRequest/>
// 找所有 觀光******************************************************************************************************************
		<SearchSightseeingCategoryRequest/>
// 找所有 @@@@@@@@@@@
		<SearchHotelGroupRequest>
		<ItemDestination DestinationType="city" DestinationCode="lon"/>
			<ItemName/>
		</SearchHotelGroupRequest>
// 項目旅館(只能捉旅館)類別下載 (超慢.....)
		<ItemInformationDownloadRequest ItemType="hotel">
		</ItemInformationDownloadRequest>
// 增加訂房請求
		<AddBookingRequest>
			<BookingReference>Booking0002</BookingReference>
			<PaxNames>
				<PaxName PaxId="1"><![CDATA[ Mr John Doe]]></PaxName>
				<PaxName PaxId="2"><![CDATA[ Mrs Sarah Doe]]></PaxName>
				<PaxName PaxId="3" PaxType="child" ChildAge="11"><![CDATA[ Master Jim Doe]]></PaxName>
			</PaxNames>
			<BookingItems>
				<BookingItem ItemType="hotel">
					<ItemReference>1</ItemReference>
					<ItemCity Code="LON"/>
					<Item Code="HEN2"/>
					<HotelItem>
						<PeriodOfStay>
							<CheckInDate>2015-03-22</CheckInDate>
							<CheckOutDate>2015-03-24</CheckOutDate>
						</PeriodOfStay>
						<HotelRooms>
							<HotelRoom Code="DB" Id="001:HEN4:9730:S9464:10852:45030" ExtraBed="false" SharingBedding="false">
								<PaxIds>
									<PaxId>1</PaxId>
									<PaxId>2</PaxId>
								</PaxIds>
							</HotelRoom>
						</HotelRooms>
					</HotelItem>
				</BookingItem>
			</BookingItems>
		</AddBookingRequest>
// 訂房
		<AddBookingItemRequest>
			<BookingReference ReferenceSource="api">1257</BookingReference>
				<BookingItems>
					<BookingItem ItemType="hotel">
						<ItemReference>1</ItemReference>
						<ItemCity Code="LON" />
						<Item Code="HEN2" />
						<ItemRemarks>
							<ItemRemark Code="LA"/>
						</ItemRemarks>
						<HotelItem>
							<PeriodOfStay>
								<CheckInDate>2015-03-22</CheckInDate>
								<CheckOutDate>2015-03-24</CheckOutDate>
							</PeriodOfStay>
							<HotelRooms>
								<HotelRoom Code="DB" Id="001:HEN4:9730:S9464:10852:45030" ExtraBed="false" SharingBedding="false">
									<PaxIds>
										<PaxId>1</PaxId>
										<PaxId>2</PaxId>
									</PaxIds>
								</HotelRoom>
							</HotelRooms>
						</HotelItem>
					</BookingItem>
				</BookingItems>
		</AddBookingItemRequest>

// 找所有
		

// 找所有
		

// 找所有
		

*/
#echo $requestData;exit;


/*********************************************/
/*         Execute Search Transaction        */
/*********************************************/
#       https://interface.demo.gta-travel.com/rbstwapi/RequestListenerServlet
# OLD _ https://interface.demo.gta-travel.com/gtaapi/RequestListenerServlet
$requestURL = 'https://interface.demo.gta-travel.com/rbstwapi/RequestListenerServlet';
$XMLTransactionHander = new XMLTransactionHander;
$responseDoc = $XMLTransactionHander->executeRequest( $requestURL, $requestData );

// Process Response XML Data
if( $responseDoc != NULL ) {
    $responseElement = $responseDoc->documentElement;
    $xpath = new DOMXPath( $responseDoc );    

    $errorsElements = $xpath->query( 'ResponseDetails/SearchHotelPriceResponse/Errors', $responseElement );
    if( $errorsElements->length > 0 ) {
        // Process Errors
        echo '<p>Invalid Search Request</p>';
    } else {

        // Process Response Data
        $searchHotelPriceReponseElements = $xpath->query( 'ResponseDetails/SearchHotelPriceResponse', $responseElement );
        foreach( $searchHotelPriceReponseElements as $searchHotelPriceReponseElement ) {
            $hotelElements = $xpath->query( 'HotelDetails/Hotel', $searchHotelPriceReponseElement );
            echo '<table >';
            foreach( $hotelElements as $key=>$hotelElement ) {
				$nb = $key+1;
                // Process each Hotel
                echo '<tr>';
                $city = $xpath->query( 'City', $hotelElement );
                $item = $xpath->query( 'Item', $hotelElement );
                $itemPrice = $xpath->query( 'ItemPrice', $hotelElement );
				
                $confirmation = $xpath->query( 'Confirmation', $hotelElement );
                echo '<td>'.$nb.'. '.$city->item(0)->textContent.'</td>';
                echo '<td>'.$item->item(0)->textContent.'</td>';
                echo '<td>'.$itemPrice->item(0)->textContent.'</td>';
                echo '<td>'.$confirmation->item(0)->textContent.'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }
} else {
    echo '<p>Invalid Search Request: '.$XMLTransactionHander->errno.'</p>';
}
