SearchHotelPriceResponse
	// 多筆 重覆******************************
	HotelDetails 酒店詳情
		Hotel - HasPictures是否有圖片 - HasExtraInfo 是否有額外
			City=London - Code=LON
			Item=Hendon Hall - Code=HEN2
			LoctionDetails=Suburbs 區域訊息
				// 多筆 重覆******************************
				Loction - Code=G8 區域代碼
			StarRating 星級
			HotelRooms
				HotelRoom - Code房型代碼 - NumberOgRooms 訂房量
			RoomCategories 房間類型清單
				// 多筆 重覆******************************
				RoomCategory 房間類型 - Id=001:HEN:9730:S9464:10852:45030
					Description 房間描述
					ItemPrice房價 - Currency幣別 - CommissionPercentage 佣金比
					Confirmation - Code 確認
					Meals 附餐
						Basis 依據 - Code 代碼
					HotelRoomPrices
						HotelRoom - Code 房型代碼
						RoomPrice - Gross 合計
						PriceRanges價格範圍
							priceRange
								DateRange日期範圍
									FromDate 由
									ToDate 至
								Price - Gross - Nights 夜數
					EssentialInformation 基本訊息
						Information 訊息
							Text 注意事項
							DateRange 日期範圍
								FromDate
								ToDate
					ChargeConditions 收費條件 - Type=cancellation / amendment
						// 多筆 重覆******************************
						ChargeCondition - Type=amendment 修正
							Condition - Currency=GBP幣別 - FromDay - ChargeAmount 收費額 - Charge是否收費 - ToDay
					PassengerNameChange客戶姓名變更 - Allowable是否允許 true/false
-------------------------------------------------------------------------------------------------------------------------

可用XML代碼

$requestData = '<?xml version="1.0" encoding="UTF-8"?>
<Request>
	<Source>
		<RequestorID Client="84" EMailAddress="XML@IHBC.COM.TW" Password="PASS"/>
		<RequestorPreferences Language="en" Currency="GBP" Country="GB">
			<RequestMode>SYNCHRONOUS</RequestMode>
		</RequestorPreferences>
	</Source>
	<RequestDetails>
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
// 找所有
		
// 找所有
		
-------------------------------------------------------------------------------------------------------------------------
*/
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [ResponseReference] => REF_D_020_84-2001423017053252
        )

    [ResponseDetails] => SimpleXMLElement Object
        (
            [@attributes] => Array
                (
                    [Language] => en
                )

            [SearchHotelPriceResponse] => SimpleXMLElement Object
                (
                    [HotelDetails] => SimpleXMLElement Object
                        (
                            [Hotel] => Array
                                (
                                    [0] => SimpleXMLElement Object
                                        (
                                            [@attributes] => Array
                                                (
                                                    [HasExtraInfo] => true
                                                    [HasPictures] => true
                                                )

                                            [City] => SimpleXMLElement Object
                                                (
                                                    [@attributes] => Array
                                                        (
                                                            [Code] => LON
                                                        )

                                                )

                                            [Item] => SimpleXMLElement Object
                                                (
                                                    [@attributes] => Array
                                                        (
                                                            [Code] => HEN2
                                                        )

                                                )

                                            [LocationDetails] => SimpleXMLElement Object
                                                (
                                                    [Location] => SimpleXMLElement Object
                                                        (
                                                            [@attributes] => Array
                                                                (
                                                                    [Code] => G8
                                                                )

                                                        )

                                                )

                                            [StarRating] => 4
                                            [HotelRooms] => SimpleXMLElement Object
                                                (
                                                    [HotelRoom] => SimpleXMLElement Object
                                                        (
                                                            [@attributes] => Array
                                                                (
                                                                    [Code] => DB
                                                                    [NumberOfRooms] => 1
                                                                )

                                                        )

                                                )

                                            [RoomCategories] => SimpleXMLElement Object
                                                (
                                                    [RoomCategory] => Array
                                                        (
                                                            [0] => SimpleXMLElement Object
                                                                (
                                                                    [@attributes] => Array
                                                                        (
                                                                            [Id] => 001:HEN4:9730:S9464:10852:45030
                                                                        )

                                                                    [Description] => SimpleXMLElement Object
                                                                        (
                                                                        )

                                                                    [ItemPrice] => 114.50
                                                                    [Confirmation] => SimpleXMLElement Object
                                                                        (
                                                                            [@attributes] => Array
                                                                                (
                                                                                    [Code] => IM
                                                                                )

                                                                        )

                                                                    [Meals] => SimpleXMLElement Object
                                                                        (
                                                                            [Basis] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => N
                                                                                        )

                                                                                )

                                                                        )

                                                                    [HotelRoomPrices] => SimpleXMLElement Object
                                                                        (
                                                                            [HotelRoom] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => DB
                                                                                        )

                                                                                    [RoomPrice] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Gross] => 114.50
                                                                                                )

                                                                                        )

                                                                                    [PriceRanges] => SimpleXMLElement Object
                                                                                        (
                                                                                            [PriceRange] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [FromDate] => 2015-02-20
                                                                                                            [ToDate] => 2015-02-21
                                                                                                        )

                                                                                                    [Price] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Gross] => 57.25
                                                                                                                    [Nights] => 2
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                        )

                                                                    [ChargeConditions] => SimpleXMLElement Object
                                                                        (
                                                                            [ChargeCondition] => Array
                                                                                (
                                                                                    [0] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => cancellation
                                                                                                )

                                                                                            [Condition] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [@attributes] => Array
                                                                                                        (
                                                                                                            [Charge] => true
                                                                                                            [ChargeAmount] => 114.50
                                                                                                            [Currency] => GBP
                                                                                                            [FromDay] => 0
                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                    [1] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => amendment
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 114.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 57.25
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                            [PassengerNameChange] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Allowable] => true
                                                                                        )

                                                                                )

                                                                        )

                                                                )

                                                            [1] => SimpleXMLElement Object
                                                                (
                                                                    [@attributes] => Array
                                                                        (
                                                                            [Id] => 001:HEN2:9730:S9464:10842:45030
                                                                        )

                                                                    [Description] => SimpleXMLElement Object
                                                                        (
                                                                        )

                                                                    [ItemPrice] => 239.00
                                                                    [Confirmation] => SimpleXMLElement Object
                                                                        (
                                                                            [@attributes] => Array
                                                                                (
                                                                                    [Code] => IM
                                                                                )

                                                                        )

                                                                    [Meals] => SimpleXMLElement Object
                                                                        (
                                                                            [Basis] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => B
                                                                                        )

                                                                                )

                                                                            [Breakfast] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => F
                                                                                        )

                                                                                )

                                                                        )

                                                                    [HotelRoomPrices] => SimpleXMLElement Object
                                                                        (
                                                                            [HotelRoom] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => DB
                                                                                        )

                                                                                    [RoomPrice] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Gross] => 239.00
                                                                                                )

                                                                                        )

                                                                                    [PriceRanges] => SimpleXMLElement Object
                                                                                        (
                                                                                            [PriceRange] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [FromDate] => 2015-02-20
                                                                                                            [ToDate] => 2015-02-21
                                                                                                        )

                                                                                                    [Price] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Gross] => 119.50
                                                                                                                    [Nights] => 2
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                        )

                                                                    [EssentialInformation] => SimpleXMLElement Object
                                                                        (
                                                                            [Information] => Array
                                                                                (
                                                                                    [0] => SimpleXMLElement Object
                                                                                        (
                                                                                            [Text] => SimpleXMLElement Object
                                                                                                (
                                                                                                )

                                                                                            [DateRange] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [FromDate] => 2013-04-13
                                                                                                    [ToDate] => 2015-03-13
                                                                                                )

                                                                                        )

                                                                                    [1] => SimpleXMLElement Object
                                                                                        (
                                                                                            [Text] => SimpleXMLElement Object
                                                                                                (
                                                                                                )

                                                                                            [DateRange] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [FromDate] => 2013-04-12
                                                                                                    [ToDate] => 2015-04-12
                                                                                                )

                                                                                        )

                                                                                )

                                                                        )

                                                                    [ChargeConditions] => SimpleXMLElement Object
                                                                        (
                                                                            [ChargeCondition] => Array
                                                                                (
                                                                                    [0] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => cancellation
                                                                                                )

                                                                                            [Condition] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [@attributes] => Array
                                                                                                        (
                                                                                                            [Charge] => true
                                                                                                            [ChargeAmount] => 239.00
                                                                                                            [Currency] => GBP
                                                                                                            [FromDay] => 0
                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                    [1] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => amendment
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 239.00
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 119.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                            [PassengerNameChange] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Allowable] => true
                                                                                        )

                                                                                )

                                                                        )

                                                                )

                                                        )

                                                )

                                        )

                                    [1] => SimpleXMLElement Object
                                        (
                                            [@attributes] => Array
                                                (
                                                    [HasExtraInfo] => true
                                                    [HasPictures] => true
                                                )

                                            [City] => SimpleXMLElement Object
                                                (
                                                    [@attributes] => Array
                                                        (
                                                            [Code] => LON
                                                        )

                                                )

                                            [Item] => SimpleXMLElement Object
                                                (
                                                    [@attributes] => Array
                                                        (
                                                            [Code] => GEN
                                                        )

                                                )

                                            [LocationDetails] => SimpleXMLElement Object
                                                (
                                                    [Location] => Array
                                                        (
                                                            [0] => SimpleXMLElement Object
                                                                (
                                                                    [@attributes] => Array
                                                                        (
                                                                            [Code] => G1
                                                                        )

                                                                )

                                                            [1] => SimpleXMLElement Object
                                                                (
                                                                    [@attributes] => Array
                                                                        (
                                                                            [Code] => 03
                                                                        )

                                                                )

                                                        )

                                                )

                                            [StarRating] => 1
                                            [HotelRooms] => SimpleXMLElement Object
                                                (
                                                    [HotelRoom] => SimpleXMLElement Object
                                                        (
                                                            [@attributes] => Array
                                                                (
                                                                    [Code] => DB
                                                                    [NumberOfRooms] => 1
                                                                )

                                                        )

                                                )

                                            [RoomCategories] => SimpleXMLElement Object
                                                (
                                                    [RoomCategory] => Array
                                                        (
                                                            [0] => SimpleXMLElement Object
                                                                (
                                                                    [@attributes] => Array
                                                                        (
                                                                            [Id] => 001:GEN1:9725:S9502:10859:45163
                                                                        )

                                                                    [Description] => SimpleXMLElement Object
                                                                        (
                                                                        )

                                                                    [ItemPrice] => 140.50
                                                                    [Confirmation] => SimpleXMLElement Object
                                                                        (
                                                                            [@attributes] => Array
                                                                                (
                                                                                    [Code] => IM
                                                                                )

                                                                        )

                                                                    [Meals] => SimpleXMLElement Object
                                                                        (
                                                                            [Basis] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => B
                                                                                        )

                                                                                )

                                                                            [Breakfast] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => C
                                                                                        )

                                                                                )

                                                                        )

                                                                    [HotelRoomPrices] => SimpleXMLElement Object
                                                                        (
                                                                            [HotelRoom] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => DB
                                                                                        )

                                                                                    [RoomPrice] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Gross] => 140.50
                                                                                                )

                                                                                        )

                                                                                    [PriceRanges] => SimpleXMLElement Object
                                                                                        (
                                                                                            [PriceRange] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [FromDate] => 2015-02-20
                                                                                                            [ToDate] => 2015-02-21
                                                                                                        )

                                                                                                    [Price] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Gross] => 70.25
                                                                                                                    [Nights] => 2
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                        )

                                                                    [EssentialInformation] => SimpleXMLElement Object
                                                                        (
                                                                            [Information] => SimpleXMLElement Object
                                                                                (
                                                                                    [Text] => SimpleXMLElement Object
                                                                                        (
                                                                                        )

                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                        (
                                                                                            [FromDate] => 0001-01-01
                                                                                            [ToDate] => 9999-12-31
                                                                                        )

                                                                                )

                                                                        )

                                                                    [ChargeConditions] => SimpleXMLElement Object
                                                                        (
                                                                            [ChargeCondition] => Array
                                                                                (
                                                                                    [0] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => cancellation
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 140.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 70.25
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                    [1] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => amendment
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 140.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 70.25
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                            [PassengerNameChange] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Allowable] => true
                                                                                        )

                                                                                )

                                                                        )

                                                                )

                                                            [1] => SimpleXMLElement Object
                                                                (
                                                                    [@attributes] => Array
                                                                        (
                                                                            [Id] => 001:GEN:9725:S9502:10859:45176
                                                                        )

                                                                    [Description] => SimpleXMLElement Object
                                                                        (
                                                                        )

                                                                    [ItemPrice] => 166.50
                                                                    [Confirmation] => SimpleXMLElement Object
                                                                        (
                                                                            [@attributes] => Array
                                                                                (
                                                                                    [Code] => IM
                                                                                )

                                                                        )

                                                                    [Meals] => SimpleXMLElement Object
                                                                        (
                                                                            [Basis] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => B
                                                                                        )

                                                                                )

                                                                            [Breakfast] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => C
                                                                                        )

                                                                                )

                                                                        )

                                                                    [HotelRoomPrices] => SimpleXMLElement Object
                                                                        (
                                                                            [HotelRoom] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => DB
                                                                                        )

                                                                                    [RoomPrice] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Gross] => 166.50
                                                                                                )

                                                                                        )

                                                                                    [PriceRanges] => SimpleXMLElement Object
                                                                                        (
                                                                                            [PriceRange] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [FromDate] => 2015-02-20
                                                                                                            [ToDate] => 2015-02-21
                                                                                                        )

                                                                                                    [Price] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Gross] => 83.25
                                                                                                                    [Nights] => 2
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                        )

                                                                    [EssentialInformation] => SimpleXMLElement Object
                                                                        (
                                                                            [Information] => SimpleXMLElement Object
                                                                                (
                                                                                    [Text] => SimpleXMLElement Object
                                                                                        (
                                                                                        )

                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                        (
                                                                                            [FromDate] => 0001-01-01
                                                                                            [ToDate] => 9999-12-31
                                                                                        )

                                                                                )

                                                                        )

                                                                    [ChargeConditions] => SimpleXMLElement Object
                                                                        (
                                                                            [ChargeCondition] => Array
                                                                                (
                                                                                    [0] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => cancellation
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 166.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 83.25
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                    [1] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => amendment
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 166.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 83.25
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                            [PassengerNameChange] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Allowable] => true
                                                                                        )

                                                                                )

                                                                        )

                                                                )

                                                            [2] => SimpleXMLElement Object
                                                                (
                                                                    [@attributes] => Array
                                                                        (
                                                                            [Id] => 001:GEN:9725:S9502:10859:45174
                                                                        )

                                                                    [Description] => SimpleXMLElement Object
                                                                        (
                                                                        )

                                                                    [ItemPrice] => 224.50
                                                                    [Confirmation] => SimpleXMLElement Object
                                                                        (
                                                                            [@attributes] => Array
                                                                                (
                                                                                    [Code] => IM
                                                                                )

                                                                        )

                                                                    [Meals] => SimpleXMLElement Object
                                                                        (
                                                                            [Basis] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => B
                                                                                        )

                                                                                )

                                                                            [Breakfast] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => C
                                                                                        )

                                                                                )

                                                                        )

                                                                    [HotelRoomPrices] => SimpleXMLElement Object
                                                                        (
                                                                            [HotelRoom] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => DB
                                                                                        )

                                                                                    [RoomPrice] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Gross] => 224.50
                                                                                                )

                                                                                        )

                                                                                    [PriceRanges] => SimpleXMLElement Object
                                                                                        (
                                                                                            [PriceRange] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [FromDate] => 2015-02-20
                                                                                                            [ToDate] => 2015-02-21
                                                                                                        )

                                                                                                    [Price] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Gross] => 112.25
                                                                                                                    [Nights] => 2
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                        )

                                                                    [EssentialInformation] => SimpleXMLElement Object
                                                                        (
                                                                            [Information] => SimpleXMLElement Object
                                                                                (
                                                                                    [Text] => SimpleXMLElement Object
                                                                                        (
                                                                                        )

                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                        (
                                                                                            [FromDate] => 0001-01-01
                                                                                            [ToDate] => 9999-12-31
                                                                                        )

                                                                                )

                                                                        )

                                                                    [ChargeConditions] => SimpleXMLElement Object
                                                                        (
                                                                            [ChargeCondition] => Array
                                                                                (
                                                                                    [0] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => cancellation
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 224.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 112.25
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                    [1] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => amendment
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 224.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 112.25
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                            [PassengerNameChange] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Allowable] => true
                                                                                        )

                                                                                )

                                                                        )

                                                                )

                                                            [3] => SimpleXMLElement Object
                                                                (
                                                                    [@attributes] => Array
                                                                        (
                                                                            [Id] => 001:GEN:9725:S9502:10859:45167
                                                                        )

                                                                    [Description] => SimpleXMLElement Object
                                                                        (
                                                                        )

                                                                    [ItemPrice] => 281.00
                                                                    [Confirmation] => SimpleXMLElement Object
                                                                        (
                                                                            [@attributes] => Array
                                                                                (
                                                                                    [Code] => IM
                                                                                )

                                                                        )

                                                                    [Meals] => SimpleXMLElement Object
                                                                        (
                                                                            [Basis] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => B
                                                                                        )

                                                                                )

                                                                            [Breakfast] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => C
                                                                                        )

                                                                                )

                                                                        )

                                                                    [HotelRoomPrices] => SimpleXMLElement Object
                                                                        (
                                                                            [HotelRoom] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Code] => DB
                                                                                        )

                                                                                    [RoomPrice] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Gross] => 281.00
                                                                                                )

                                                                                        )

                                                                                    [PriceRanges] => SimpleXMLElement Object
                                                                                        (
                                                                                            [PriceRange] => SimpleXMLElement Object
                                                                                                (
                                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [FromDate] => 2015-02-20
                                                                                                            [ToDate] => 2015-02-21
                                                                                                        )

                                                                                                    [Price] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Gross] => 140.50
                                                                                                                    [Nights] => 2
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                        )

                                                                    [EssentialInformation] => SimpleXMLElement Object
                                                                        (
                                                                            [Information] => SimpleXMLElement Object
                                                                                (
                                                                                    [Text] => SimpleXMLElement Object
                                                                                        (
                                                                                        )

                                                                                    [DateRange] => SimpleXMLElement Object
                                                                                        (
                                                                                            [FromDate] => 0001-01-01
                                                                                            [ToDate] => 9999-12-31
                                                                                        )

                                                                                )

                                                                        )

                                                                    [ChargeConditions] => SimpleXMLElement Object
                                                                        (
                                                                            [ChargeCondition] => Array
                                                                                (
                                                                                    [0] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => cancellation
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 281.00
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 140.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                    [1] => SimpleXMLElement Object
                                                                                        (
                                                                                            [@attributes] => Array
                                                                                                (
                                                                                                    [Type] => amendment
                                                                                                )

                                                                                            [Condition] => Array
                                                                                                (
                                                                                                    [0] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 281.00
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 0
                                                                                                                    [ToDay] => 2
                                                                                                                )

                                                                                                        )

                                                                                                    [1] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => true
                                                                                                                    [ChargeAmount] => 140.50
                                                                                                                    [Currency] => GBP
                                                                                                                    [FromDay] => 3
                                                                                                                    [ToDay] => 5
                                                                                                                )

                                                                                                        )

                                                                                                    [2] => SimpleXMLElement Object
                                                                                                        (
                                                                                                            [@attributes] => Array
                                                                                                                (
                                                                                                                    [Charge] => false
                                                                                                                    [FromDay] => 6
                                                                                                                )

                                                                                                        )

                                                                                                )

                                                                                        )

                                                                                )

                                                                            [PassengerNameChange] => SimpleXMLElement Object
                                                                                (
                                                                                    [@attributes] => Array
                                                                                        (
                                                                                            [Allowable] => true
                                                                                        )

                                                                                )

                                                                        )

                                                                )

                                                        )

                                                )

                                        )

                                )

                        )

                )

        )

)
