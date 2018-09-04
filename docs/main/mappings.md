# Mappings

Data for the system is populated using the National Statistics Postcode Lookup (NSPL). This is updated regularly and 
this fact would cause issues if you tried to automate imports.

Some of the data provided will be named according to their most recent update. Some tables change monthly/yearly, while 
some are effectively static. As these names regularly change, and to preserve relatively easy backwards compatibility, 
renamings must be done manually.

From the original data, copy out the appropriate CSV files and place them in `/database/source`. They should be 
renamed as follows:


| Approximate name | Example Name | Function of table | Required name |
| ---------------- |:------------:|:-----------------:| ------------- |
| NSPL_(month)_20(xx)_UK.csv | NSPL_MAY_2018_UK.csv | Main postcode lookup | npsl.csv |
| Country names and codes UK as at (date).csv | Country names and codes UK as at 08_12.csv | Counties list | counties.csv |
| County Electoral Division names and codes EN as at (date).csv | County Electoral Division names and codes EN as at 12_17.csv | Counties list | ceds.csv |
| oa11 (to be completed) | - | - | - |
| LA_UA names and codes UK as at (date).csv | LA_UA names and codes UK as at 12_16.csv | LAUA list | lauas.csv |
| Ward names and codes UK as at (date).csv | Ward names and codes UK as at 12_17.csv | Ward list | wards.csv |
| HLTHAU names and codes UK as at (date).csv | HLTHAU names and codes UK as at 12_16.csv | HLTHAU list | hlthau.csv |
| NHSER names and codes EN as at (date).csv | NHSER names and codes EN as at 04_17.csv | NHSER list | nhser.csv |
| Country names and codes UK as at (date).csv | Country names and codes UK as at 08_12.csv | Countries list | countries.csv |
| Region names and codes EN as at (date).csv | Region names and codes EN as at 12_10 (GOR).csv | Regions list | rgns.csv |
| Westminster Parliamentary Constituency names and codes UK as at (date).csv | Westminster Parliamentary Constituency names and codes UK as at 12_14.csv | Parlaimentary Consituency names list | pcons.csv |
| EER names and codes UK as at (date).csv | EER names and codes UK as at 12_10.csv | EU Consituency names list | eers.csv |
| TECLEC names and codes UK as at (date).csv | TECLEC names and codes UK as at 12_16.csv | TECLEC | teclecs.csv |
| TTWA names and codes UK as at (date)(version number).csv | TTWA names and codes UK as at 12_11 v5.csv | TTWA lists | ttwas.csv |
| PCT names and codes UK as at 12_16 (date).csv | PCT names and codes UK as at 12_16.csv | PCT lists | pcts.csv |
| LAU2 names and codes UK as at (date) (NUTS).csv | LAU2 names and codes UK as at 12_16 (NUTS).csv | NUTS lists | nutss.csv |
| National Park names and codes GB as at (date).csv | National Park names and codes GB as at 08_16.csv | Park lists | parks.csv |
| LSOA (date) names and codes UK as at (date).csv | LSOA (2011) names and codes UK as at 12_12.csv | LSOA list | lsoa11s.csv |
| wz11 (to be completed) | - | - | - |
| CCG names and codes UK as at (date).csv | CCG names and codes UK as at 04_18.csv | CCG list | ccgs.csv |
| BUA_names and codes UK as at (date).csv | BUA_names and codes UK as at 12_13.csv | BUA list | bua11s.csv |
| BUASD_names and codes UK as at (date).csv | BUASD_names and codes UK as at 12_13.csv | BUASD list | buasd11s.csv |
| Rural Urban (date) Indicator names and codes GB as at (date).csv | Rural Urban (2011) Indicator names and codes GB as at 12_16.csv | RU list | ru11inds.csv |
| (date) Census Output Area Classification Names and Codes UK.csv | 2011 Census Output Area Classification Names and Codes UK.csv | OAC11 list | oac11s.csv |
| LEP names and codes EN as at (date) (version).csv | LEP names and codes EN as at 04_17 v2.csv | LEP 1 list | leps.csv |
| PFA names and codes GB as at (date).csv | PFA names and codes GB as at 12_15.csv | Police Lists | pfas.csv |
| IMD lookup EN as at (date).csv | IMD lookup EN as at 12_15.csv | English IMD | imd_ens.csv |
| IMD lookup SC as at (date).csv | IMD lookup SC as at 12_15.csv | Scottish IMD | imd_scs.csv |
| IMD lookup WA as at (date).csv | IMD lookup WA as at 12_15.csv | Welsh IMD | imd_was.csv |

