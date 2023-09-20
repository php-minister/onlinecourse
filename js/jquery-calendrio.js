/**
 * jquery.calendario.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2012, Codrops
 * http://www.codrops.com
 */
;( function( $, window, undefined ) {
	
	'use strict';

	$.Calendario = function( options, element ) {
		
		this.$el = $( element );
		this._init( options );
		
	};

	// the options
	$.Calendario.defaults = {
		weeks : [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ],
		weekabbrs : [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],
		months : [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
		monthabbrs : [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
		// choose between values in options.weeks or options.weekabbrs
		displayWeekAbbr : false,
		// choose between values in options.months or options.monthabbrs
		displayMonthAbbr : false,
		// left most day in the calendar
		// 0 - Sunday, 1 - Monday, ... , 6 - Saturday
		startIn : 1,
		onDayClick : function( $el, $content, dateProperties ) { return false; },
        afterEventTitleRender:function(event,date){return '';}
	};

	$.Calendario.prototype = {

		_init : function( options ) {
			
			// options
			this.options = $.extend( true, {}, $.Calendario.defaults, options );

			this.today = new Date();
			this.month = ( isNaN( this.options.month ) || this.options.month == null) ? this.today.getMonth() : this.options.month - 1;
			this.year = ( isNaN( this.options.year ) || this.options.year == null) ? this.today.getFullYear() : this.options.year;
            this.setData(this.options.caldata);
			//this.caldata = this.options.caldata || {};
			this._generateTemplate();
			this._initEvents();

		},
		_initEvents : function() {

			var self = this;

			this.$el.on( 'click.calendario', 'div.fc-row > div', function() {

				var $cell = $( this ),
					idx = $cell.index(),
					$content = $cell.children( 'div' ),
					dateProp = {
						day : $cell.children( 'span.fc-date' ).text(),
						month : self.month + 1,
						monthname : self.options.displayMonthAbbr ? self.options.monthabbrs[ self.month ] : self.options.months[ self.month ],
						year : self.year,
						weekday : idx + self.options.startIn,
						weekdayname : self.options.weeks[ idx + self.options.startIn ]
					};

				if( dateProp.day ) {
					self.options.onDayClick( $cell, $content, dateProp );
				}

			} );

		},
		// Calendar logic based on http://jszen.blogspot.pt/2007/03/how-to-build-simple-calendar-with.html
		_generateTemplate : function( callback ) {

			var head = this._getHead(),
				body = this._getBody(),
				rowClass;

			switch( this.rowTotal ) {
				case 4 : rowClass = 'fc-four-rows'; break;
				case 5 : rowClass = 'fc-five-rows'; break;
				case 6 : rowClass = 'fc-six-rows'; break;
			}

			this.$cal = $( '<div class="fc-calendar ' + rowClass + '">' ).append( head, body );

			this.$el.find( 'div.fc-calendar' ).remove().end().append( this.$cal );

			if( callback ) { callback.call(); }

		},
		_getHead : function() {

			var html = '<div class="fc-head">';
		
			for ( var i = 0; i <= 6; i++ ) {

				var pos = i + this.options.startIn,
					j = pos > 6 ? pos - 6 - 1 : pos;

				html += '<div>';
				html += this.options.displayWeekAbbr ? this.options.weekabbrs[ j ] : this.options.weeks[ j ];
				html += '</div>';

			}

			html += '</div>';

			return html;

		},
		_getBody : function() {
			var d = new Date( this.year, this.month + 1, 0 ),
				// number of days in the month
				monthLength = d.getDate(),
				firstDay = new Date( this.year, this.month, 1 );

			// day of the week
			this.startingDay = firstDay.getDay();

			var html = '<div class="fc-body"><div class="fc-row">',
				// fill in the days
				day = 1;

			// this loop is for weeks (rows)
			for ( var i = 0; i < 7; i++ ) {

				// this loop is for weekdays (cells)
				for ( var j = 0; j <= 6; j++ ) {

					var pos = this.startingDay - this.options.startIn,
						p = pos < 0 ? 6 + pos + 1 : pos,
						inner = '',
						today = this.month === this.today.getMonth() && this.year === this.today.getFullYear() && day === this.today.getDate(),
						content = '';
					
					if ( day <= monthLength && ( i > 0 || j >= p ) ) {

						inner += '<span class="fc-date">' + day + '</span><span class="fc-weekday">' + this.options.weekabbrs[ j + this.options.startIn > 6 ? j + this.options.startIn - 6 - 1 : j + this.options.startIn ] + '</span>';

						// this day is:
						var strdate = ( this.month + 1 < 10 ? '0' + ( this.month + 1 ) : this.month + 1 ) + '-' + ( day < 10 ? '0' + day : day ) + '-' + this.year,
							dayData = this.caldata[ strdate ];
						if( dayData ) {
                            for(var index in dayData)
                            {
                                var start_date=new Date(strdate+' '+dayData[index].start);
                                start_date=start_date.getHours()+':'+(start_date.getMinutes()<10?('0'+start_date.getMinutes()):start_date.getMinutes());
                                
                                var end_date=new Date(strdate+' '+dayData[index].end);
																
                                end_date=end_date.getHours()+':'+(end_date.getMinutes()<10?('0'+end_date.getMinutes()):end_date.getMinutes());
                                var start_array = dayData[index].start.split(':');
								var start_time = start_array[0]+':'+start_array[1];
								var end_array = dayData[index].end.split(':');
								var end_time = end_array[0]+':'+end_array[1];
                                content +='<span title="'+dayData[index].start+' - '+dayData[index].end+', '+dayData[index].title.replace('{|}', ' ') + '" '+(dayData[index].allow_edit==0?' class="event-disabled"':'')+' id="'+dayData[index].id+'" class="trigger_class">' + start_time +' '+end_time	+' '+dayData[index].title.split('{|}')[0]+'</span>';
                            }
						}

						if( content !== '' ) {
							inner += '<div>' + content + '</div>';
						}

						++day;

					}
					else {
						today = false;
					}

					var cellClasses = today ? 'fc-today ' : '';
					if( content !== '' ) {
						cellClasses += 'fc-content';
					}

					html += cellClasses !== '' ? '<div class="' + cellClasses + '">' : '<div>';
					html += inner;
					html += '</div>';

				}

				// stop making rows if we've run out of days
				if (day > monthLength) {
					this.rowTotal = i + 1;
					break;
				} 
				else {
					html += '</div><div class="fc-row">';
				}

			}
			html += '</div></div>';

			return html;

		},
		// based on http://stackoverflow.com/a/8390325/989439
		_isValidDate : function( date ) {

			date = date.replace(/-/gi,'');
			var month = parseInt( date.substring( 0, 2 ), 10 ),
				day = parseInt( date.substring( 2, 4 ), 10 ),
				year = parseInt( date.substring( 4, 8 ), 10 );

			if( ( month < 1 ) || ( month > 12 ) ) {
				return false;
			}
			else if( ( day < 1 ) || ( day > 31 ) )  {
				return false;
			}
			else if( ( ( month == 4 ) || ( month == 6 ) || ( month == 9 ) || ( month == 11 ) ) && ( day > 30 ) )  {
				return false;
			}
			else if( ( month == 2 ) && ( ( ( year % 400 ) == 0) || ( ( year % 4 ) == 0 ) ) && ( ( year % 100 ) != 0 ) && ( day > 29 ) )  {
				return false;
			}
			else if( ( month == 2 ) && ( ( year % 100 ) == 0 ) && ( day > 29 ) )  {
				return false;
			}

			return {
				day : day,
				month : month,
				year : year
			};

		},
		_move : function( period, dir, callback ) {

			if( dir === 'previous' ) {
				
				if( period === 'month' ) {
					this.year = this.month > 0 ? this.year : --this.year;
					this.month = this.month > 0 ? --this.month : 11;
				}
				else if( period === 'year' ) {
					this.year = --this.year;
				}

			}
			else if( dir === 'next' ) {

				if( period === 'month' ) {
					this.year = this.month < 11 ? this.year : ++this.year;
					this.month = this.month < 11 ? ++this.month : 0;
				}
				else if( period === 'year' ) {
					this.year = ++this.year;
				}

			}

			this._generateTemplate( callback );

		},
		/************************* 
		******PUBLIC METHODS *****
		**************************/
		getYear : function() {
			return this.year;
		},
		getMonth : function() {
			return this.month + 1;
		},
		getMonthName : function() {
			return this.options.displayMonthAbbr ? this.options.monthabbrs[ this.month ] : this.options.months[ this.month ];
		},
		// gets the cell's content div associated to a day of the current displayed month
		// day : 1 - [28||29||30||31]
		getCell : function( day ) {

			var row = Math.floor( ( day + this.startingDay - this.options.startIn ) / 7 ),
				pos = day + this.startingDay - this.options.startIn - ( row * 7 ) - 1;

			return this.$cal.find( 'div.fc-body' ).children( 'div.fc-row' ).eq( row ).children( 'div' ).eq( pos ).children( 'div' );

		},
		setData : function( caldata ) {
            var new_data={};
            for(var index in caldata)
            {
               if (typeof(new_data[caldata[index].date])=='undefined')
               {
                   new_data[caldata[index].date]=new Object();
               }
               
               new_data[caldata[index].date][caldata[index].id]={'start':caldata[index].start_time,'end':caldata[index].end_time,'title':caldata[index].title,'allow_edit':(caldata[index].allow_edit==undefined)?1:caldata[index].allow_edit,'id':caldata[index].id,'is_commented':(caldata[index].is_commented==undefined)?1:caldata[index].is_commented};
            }
            this.caldata=new_data;
			//caldata = caldata || {};
			//$.extend( this.caldata, caldata );
			this._generateTemplate();

		},
        removeEvent : function(event_id,update)
        {
            update = update || true;
            for(var date in this.caldata)
            {
                for(var index in this.caldata[date])
                {
                    if (this.caldata[date][index].id==event_id)
                    {
                        delete this.caldata[date][index];
                        if (this.caldata[date].length==0)
                        {
                            delete this.caldata[date];
                        }
                        if (update)
                        {
                            this._generateTemplate();    
                        }
                        return ;
                    }
                }
            }
        },
        addEvent : function(event)
        {
           if (typeof(this.caldata[event.date])=='undefined')
           {
                   this.caldata[event.date]=new Object();
           }
           this.caldata[event.date][event.id]={'start':event.start_time,'end':event.end_time,'title':event.title,'allow_edit':(event.allow_edit==undefined)?1:event.allow_edit,'id':event.id}
           this._generateTemplate();
        },
        changeAttribute:function(event_date,event_id,attr,value)
        {
            this.caldata[event_date][event_id][attr]=value;
        },
		// goes to today's month/year
		gotoNow : function( callback ) {

			this.month = this.today.getMonth();
			this.year = this.today.getFullYear();
			this._generateTemplate( callback );

		},
		// goes to month/year
		goto : function( month, year, callback ) {

			this.month = month;
			this.year = year;
			this._generateTemplate( callback );

		},
		gotoPreviousMonth : function( callback ) {
			this._move( 'month', 'previous', callback );
		},
		gotoPreviousYear : function( callback ) {
			this._move( 'year', 'previous', callback );
		},
		gotoNextMonth : function( callback ) {
			this._move( 'month', 'next', callback );
		},
		gotoNextYear : function( callback ) {
			this._move( 'year', 'next', callback );
		},
        getDate : function(date)
        {
            date=(date.month<10?('0'+date.month):date.month)+'-'+(date.day<10?('0'+date.day):date.day)+'-'+date.year;
            if (this.caldata[date]==undefined)
            {
                return false;
            }
            
            var dates='';
            var i=1;
			var h_24 = 0;
			var mins = 0;
			var s_time = 0;
			var e_time = 0;
			var mins2 =0
			var h_25= 0;
			
            for(var index in this.caldata[date])
            {
                i++;
				var s_times = this.caldata[date][index].start.replace(/:[0-9]+$/gi,'');
				var e_times = this.caldata[date][index].end.replace(/:[0-9]+$/gi,'');
					h_24 = s_times.split(':')[0];
					mins = s_times.split(':')[1];
					var h = h_24 % 12;
					if (h === 0) h = 12;
					s_time = (h < 10 ? "0" + h : h) + ":" +mins +'  '+(h_24 < 12 ? 'am' : 'pm');
					
					
					h_25 = e_times.split(':')[0];
					mins2 = e_times.split(':')[1];
					var h = h_25 % 12;
					if (h === 0) h = 12;
					e_time = (h < 10 ? "0" + h : h) + ":" +mins2 +'  '+(h_25 < 12 ? 'am' : 'pm');					
				
                dates +='<li class="event '+(i%2==0?'even':'odd')+'" id="div_'+index+'_'+i+'">'+
                       '<div class="time">'+s_time+' - '+e_time+'</div>'+
                       '<div class="title">';
                
                
                 dates += ((this.options.url_template!=undefined) && (this.caldata[date][index].allow_edit==1))?('<a href="'+this.options.url_template.replace('{{event_id}}',this.caldata[date][index].id)+'" onclick="$(\'#day_scheduling\').modal(\'hide\')" data-target="#waiting_for_response" data-toggle="modal">'):'<span>';
                 
                 dates += this.caldata[date][index].title.split('{|}')[0];
                 
                 dates += ((this.options.url_template!=undefined) && (this.caldata[date][index].allow_edit==1))?'</a>':'</span>';                       
				 
				 var students_populate = '';
				 for(var k=0; k<this.caldata[date][index].title.split(',').length; k++)
				 {
					 if(k == 0 || k==1)
					 {
						 continue;
					 }
					 
					students_populate += this.caldata[date][index].title.split(',')[k];
			     }

                 dates +='</div>'+
                         this.options.afterEventTitleRender(this.caldata[date][index],date)+
                         '<div class="clearfix"></div>'+
                         '<p class="description"><b>Students :</b>'+students_populate+'</p></li>';
						 
/*				if(this.caldata[date][index].title!='Al Quran{|}')
				{
					dates += '<p><b>Students :</b>'+this.caldata[date][index].title.split(',')+'</p></li>';
				}*/
            }
            
            
            return '<ul class="day_events">'+dates+'</ul>';
        }
	};
	
	var logError = function( message ) {

		if ( window.console ) {

			window.console.error( message );
		
		}

	};
	
	$.fn.calendario = function( options ) {

		var instance = $.data( this, 'calendario' );
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			
			this.each(function() {
			
				if ( !instance ) {

					logError( "cannot call methods on calendario prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				
				}
				
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {

					logError( "no such method '" + options + "' for calendario instance" );
					return;
				
				}
				
				instance[ options ].apply( instance, args );
			
			});
		
		} 
		else {
		
			this.each(function() {
				
				if ( instance ) {

					instance._init();
				
				}
				else {

					instance = $.data( this, 'calendario', new $.Calendario( options, this ) );
				
				}

			});
		
		}
		
        var $month=$('#custom-month').html(instance.getMonthName());
        var $year=$('#custom-year').html(instance.getYear());
        $('#custom-next').on('click',function(){instance.gotoNextMonth(updateMonthYear);});
        $('#custom-prev').on('click',function(){instance.gotoPreviousMonth(updateMonthYear);});
        $('#custom-current').on('click',function(){instance.gotoNow(updateMonthYear);});
        
        function updateMonthYear(){$month.html( instance.getMonthName() );$year.html( instance.getYear() );}
        
		return instance;
		
	};
	
} )( jQuery, window );
