@extends('layout.index')

    @section("content")
      <div class="container-fluid p-3">
          <div class="card">
              <div class="card-header bg-success">Calendar</div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-sm-5">
                          <form method="post" action="{{url("/event_creation")}}">
                              {{csrf_field()}}
                          <div class="form-group">
                              <label>Event</label>
                              <input type="text" required name="event" class="form-control form-control-sm">
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-6">
                                  <label>From</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input required name="event_date_from" type="date" class="form-control form-control-sm">
                                </div>
                              </div>
                              <div class="col-sm-6">
                                  <label>To</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input required name="event_date_to" type="date" class="form-control form-control-sm">
                                </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="form-check form-check-inline">
                                <input name="days_week[]" class="form-check-input" type="checkbox" value="Monday">
                                <label class="form-check-label">Mon</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input name="days_week[]" class="form-check-input" type="checkbox" value="Tuesday">
                                <label class="form-check-label" >Tues</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input name="days_week[]" class="form-check-input" type="checkbox" value="Wednesday">
                                <label class="form-check-label">Wed</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input name="days_week[]" class="form-check-input" type="checkbox" value="Thursday">
                                <label class="form-check-label" >Thurs</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input name="days_week[]" class="form-check-input" type="checkbox" value="Friday">
                                <label class="form-check-label" >Fri</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input name="days_week[]" class="form-check-input" type="checkbox" value="Saturday">
                                <label class="form-check-label">Sat</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input name="days_week[]" class="form-check-input" type="checkbox" value="Sunday">
                                <label class="form-check-label">Sun</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <button onclick='return confirm("Do you wish to Continue?")' type="submit" class="btn btn-flat btn-primary btn-block">Save</button>
                          </div>
                            </form>
                      </div>
                      <div class="col-sm-7">
                          <div id="calendar"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    @stop
    
    @section("script")
    <script>
        $(document).ready(function(){
            $("#calendar").fullCalendar({
                  header    : {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'month,agendaWeek,agendaDay'
                  },
                  buttonText: {
                    today: 'today',
                    month: 'month',
                    week : 'week',
                    day  : 'day'
                  },
                  eventSources    : [<?php echo $eventscreated?>],
            });
        });
    </script>
    @stop